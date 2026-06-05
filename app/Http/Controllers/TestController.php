<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Test;
use App\Models\TestResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function storeTest(Request $request, Lesson $lesson)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'questions' => 'required|array|min:1',
                'questions.*.text' => 'required|string',
                'questions.*.options' => 'required|array|min:2',
                'questions.*.correct' => 'required|integer',
            ]);

            $test = Test::updateOrCreate(
                ['lesson_id' => $lesson->id],
                [
                    'title' => $validated['title'],
                    'questions' => $validated['questions']
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Тест сәтті сақталды!',
                'test' => $test
            ]);
        } catch (\Exception $e) {
            \Log::error('Test save error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Серверде қате туындады: ' . $e->getMessage()
            ], 500);
        }
    }

    public function showTest($lesson_id)
    {
        $test = Test::where('lesson_id', $lesson_id)->firstOrFail();
        return view('student.test', compact('test'));
    }

    public function show($id)
    {
        $test = Test::findOrFail($id);
        return view('student.test', compact('test'));
    }

    public function submit(Request $request, $id)
    {
        $test = Test::findOrFail($id);
        $userAnswers = $request->input('answers', []);
        $questions = $test->questions;

        $correctCount = 0;
        $wrongQuestions = [];

        foreach ($questions as $index => $q) {
            $userAnswer = $userAnswers[$index] ?? null;

            if ($userAnswer !== null && $userAnswer == $q['correct']) {
                $correctCount++;
            } else {
                $wrongQuestions[] = [
                    'index' => $index,
                    'question_text' => $q['text'],
                    'topic' => $q['topic'] ?? 'Бұл сұрақтан қате кетті',
                    'user_option' => $userAnswer !== null ? (int)$userAnswer : -1, // ✅ ДОБАВИЛИ
                ];
            }
        }

        $score = count($questions) > 0 ? round(($correctCount / count($questions)) * 100) : 0;

        $alreadyHasResult = TestResult::where('user_id', auth()->id())
            ->where('test_id', $test->id)
            ->exists();

        if (!$alreadyHasResult) {
            TestResult::create([
                'user_id' => auth()->id(),
                'test_id' => $test->id,
                'score' => $score
            ]);
        }

        return redirect()->back()->with([
            'test_results' => [
                'score' => $score,
                'wrong_questions' => $wrongQuestions,
                'is_retake' => $alreadyHasResult
            ]
        ]);
    }

    // ✅ НОВОЕ: ИИ разбор по ошибочному вопросу
    public function aiExplain(Request $request, $id)
    {
        $data = $request->validate([
            'question_index' => 'required|integer|min:0',
            'user_option' => 'required|integer|min:-1',
            'lang' => 'nullable|string|in:kk,ru',
        ]);

        $lang = $data['lang'] ?? 'kk';
        $qIndex = (int)$data['question_index'];
        $userOpt = (int)$data['user_option'];

        // Грузим тест + lesson (лекция)
        $test = Test::with('lesson')->findOrFail($id);
        $questions = $test->questions;

        if (!is_array($questions) || !isset($questions[$qIndex])) {
            return response()->json(['error' => 'Question not found'], 404);
        }

        $q = $questions[$qIndex];
        $questionText = (string)($q['text'] ?? '');
        $options = $q['options'] ?? [];
        $correctIndex = (int)($q['correct'] ?? -1); // ✅ у тебя correct

        if (!is_array($options) || $correctIndex < 0 || !isset($options[$correctIndex])) {
            return response()->json(['error' => 'Correct answer not configured'], 422);
        }

        $correctText = (string)$options[$correctIndex];
        $userText = ($userOpt >= 0 && isset($options[$userOpt])) ? (string)$options[$userOpt] : '—';

        $lesson = $test->lesson;
        $lectureTitle = (string)($lesson->title ?? '');
        $lectureHtml = (string)($lesson->content ?? ''); // ✅ по миграции это правильное поле

        $cacheKey = "ai_explain:test{$test->id}:q{$qIndex}:u{$userOpt}:lang{$lang}";

        $payload = Cache::remember($cacheKey, now()->addHours(24), function () use (
            $lang, $lectureTitle, $lectureHtml, $questionText, $correctText, $userText
        ) {
            $excerpts = $this->pickRelevantExcerpts($lectureHtml, $questionText . ' ' . $correctText, 4);

            $md = $this->callOpenAiExplain([
                'lang' => $lang,
                'lectureTitle' => $lectureTitle,
                'questionText' => $questionText,
                'userAnswer' => $userText,
                'correctAnswer' => $correctText,
                'excerpts' => $excerpts,
            ]);

            return [
                'markdown' => $md,
                'sources' => $excerpts,
            ];
        });

        return response()->json($payload);
    }

    // -----------------------------
    // Внутренние helpers (быстро)
    // -----------------------------

    private function pickRelevantExcerpts(string $lectureHtml, string $query, int $topK = 4): array
    {
        $text = trim(preg_replace('/\s+/u', ' ', strip_tags($lectureHtml)));
        $text = mb_substr($text, 0, 40000); // лимит

        $chunks = $this->chunkText($text, 900);
        $terms = $this->extractTerms($query);

        $scored = [];
        foreach ($chunks as $c) {
            $lc = mb_strtolower($c);
            $score = 0;
            foreach ($terms as $t) {
                if ($t !== '' && mb_strpos($lc, $t) !== false) $score++;
            }
            $scored[] = ['c' => $c, 's' => $score];
        }

        usort($scored, fn($a, $b) => $b['s'] <=> $a['s']);
        $best = array_slice($scored, 0, $topK);

        return array_values(array_map(fn($x) => $x['c'], $best));
    }

    private function chunkText(string $text, int $size): array
    {
        $out = [];
        $len = mb_strlen($text);
        for ($i = 0; $i < $len; $i += $size) {
            $out[] = mb_substr($text, $i, $size);
        }
        return $out;
    }

    private function extractTerms(string $query): array
    {
        $q = mb_strtolower($query);
        $q = preg_replace('/[^\p{L}\p{N}\s]+/u', ' ', $q);
        $parts = preg_split('/\s+/u', $q) ?: [];
        $parts = array_filter($parts, fn($w) => mb_strlen($w) >= 4);
        return array_slice(array_values($parts), 0, 20);
    }

    private function callOpenAiExplain(array $p): string
    {
        $apiKey = config('services.openai.key');
        if (!$apiKey) {
            return ($p['lang'] ?? 'kk') === 'ru'
                ? "Ошибка: не задан OPENAI_API_KEY в .env"
                : "Қате: .env ішінде OPENAI_API_KEY жазылмаған";
        }

        $model = config('services.openai.model', 'gpt-4o-mini');

        $instructions = ($p['lang'] ?? 'kk') === 'ru'
            ? "Ты тьютор по Python. Объясняй подробно и понятно. Не выдумывай факты, опирайся на фрагменты лекции."
            : "Сен Python тьюторсың. Толық әрі түсінікті түсіндір. Ойдан қоспа, тек лекция үзінділеріне сүйен.";

        $excerpts = $p['excerpts'] ?? [];
        $exBlock = "";
        foreach ($excerpts as $i => $ex) {
            $n = $i + 1;
            $exBlock .= "\n---[$n]---\n" . $ex . "\n";
        }

        $input =
            "Лекция: {$p['lectureTitle']}\n\n" .
            "Сұрақ: {$p['questionText']}\n" .
            "Студент жауабы: {$p['userAnswer']}\n" .
            "Дұрыс жауап: {$p['correctAnswer']}\n\n" .
            "Лекциядан үзінділер (тек осыған сүйен):\n{$exBlock}\n" .
            "Талап:\n" .
            "1) Дұрыс жауапты қысқа айт.\n" .
            "2) Неге студент қателесті (типтік қате).\n" .
            "3) Тақырыпты толық түсіндір, 1-2 мысал келтір.\n" .
            "4) Соңында: \"Лекциядан дәлел\" бөлімінде [1],[2] сияқты сілтеме жаса.\n" .
            "Формат: Markdown.\n";

        $resp = Http::withToken($apiKey)
            ->acceptJson()
            ->post('https://api.openai.com/v1/responses', [
                'model' => $model,
                'instructions' => $instructions,
                'input' => $input,
                'max_output_tokens' => 650,
                'store' => false,
            ]);

        if (!$resp->ok()) {
            return "AI error: " . $resp->status();
        }

        $json = $resp->json();
        $out = '';

        foreach (($json['output'] ?? []) as $item) {
            if (($item['type'] ?? '') !== 'message') continue;
            foreach (($item['content'] ?? []) as $c) {
                if (($c['type'] ?? '') === 'output_text') {
                    $out .= ($c['text'] ?? '');
                }
            }
        }

        return trim($out) ?: 'Жауап алынбады. Қайта көріңіз.';
    }
}
