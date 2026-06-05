<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AiTutorService
{
    public function explainWrongTestAnswer(array $payload): string
    {
        $lessonTitle   = (string)($payload['lesson_title'] ?? '');
        $lessonContent = (string)($payload['lesson_content'] ?? '');
        $questionText  = (string)($payload['question_text'] ?? '');
        $options       = (array)($payload['options'] ?? []);
        $correctText   = (string)($payload['correct_option_text'] ?? '');
        $userText      = (string)($payload['user_option_text'] ?? '');

        $context = $this->extractRelevantContext($lessonContent, $questionText, 1800);

        $instructions = "Сен Python бағдарламалау тілін үйрететін оқу ассистентісің. Түсіндірме түсінікті болсын: нақты, қадамдап, қатені көрсетіп, дұрыс жауап неге дұрыс екенін дәлелде. Соңында: 'Не қайталау керек' деген 3 қысқа тармақ бер. Жауапты қазақ тілінде бер.";

        $input = $this->buildExplainPrompt(
            $lessonTitle,
            $questionText,
            $options,
            $userText,
            $correctText,
            $context
        );

        return $this->callOpenAiResponses($instructions, $input);
    }

    public function chatAboutLesson(array $payload): string
    {
        $lessonTitle   = (string)($payload['lesson_title'] ?? '');
        $lessonContent = (string)($payload['lesson_content'] ?? '');
        $message       = (string)($payload['message'] ?? '');

        $context = $this->extractRelevantContext($lessonContent, $message, 1800);

        $instructions = "Сен Python бағдарламалау тілін үйрететін көмекші ассистентсің. Қысқа да нақты жауап бер, қажет болса Python код мысалын келтір. Тек сабақ материалына сүйен. Жауапты қазақ тілінде бер.";

        $input = "Сабақ: {$lessonTitle}\n\nКонтекст (лекциядан үзінді):\n{$context}\n\nСтудент сұрағы:\n{$message}\n\nЖауап:";

        return $this->callOpenAiResponses($instructions, $input);
    }

    private function buildExplainPrompt(
        string $lessonTitle,
        string $questionText,
        array $options,
        string $userText,
        string $correctText,
        string $context
    ): string {
        $opts = '';
        foreach ($options as $i => $opt) {
            $n = $i + 1;
            $opt = (string)$opt;
            $opts .= "{$n}) {$opt}\n";
        }

        return
            "Сабақ тақырыбы: {$lessonTitle}\n\n" .
            "Сұрақ:\n{$questionText}\n\n" .
            "Нұсқалар:\n{$opts}\n" .
            "Студент таңдаған жауап: {$userText}\n" .
            "Дұрыс жауап: {$correctText}\n\n" .
            "Лекциядан релевантты үзінді:\n{$context}\n\n" .
            "Тапсырма:\n" .
            "- Неліктен студенттің жауабы қате екенін түсіндір\n" .
            "- Дұрыс жауапты лекцияға сүйеніп дәлелде\n" .
            "- Қажет болса шағын мысал келтір\n" .
            "- Соңында 3 тармақпен 'Не қайталау керек' жаз\n";
    }

    private function callOpenAiResponses(string $instructions, string $input): string
    {
        $key  = config('services.openai.key');
        $base = rtrim((string)config('services.openai.base', 'https://api.openai.com/v1'), '/');
        $model = (string)config('services.openai.model', 'gpt-5.2');

        if (!$key) {
            return "OPENAI_API_KEY жоқ. .env ішіне кілтті қосыңыз.";
        }

        $resp = Http::withToken($key)
            ->acceptJson()
            ->contentType('application/json')
            ->timeout(25)
            ->retry(2, 200)
            ->post($base . '/responses', [
                'model' => $model,
                'instructions' => $instructions,
                'input' => $input,
                'max_output_tokens' => 600,
                'store' => false,
            ]);

        if (!$resp->ok()) {
            return "AI сервер қатесі: HTTP " . $resp->status();
        }

        $json = $resp->json();

        // Responses API: текст может быть не в output[0] — безопасно агрегируем все output_text
        $text = $this->aggregateOutputText($json);

        return trim($text) !== '' ? trim($text) : "AI жауап бос қайтты.";
    }

    private function aggregateOutputText($json): string
    {
        $out = '';

        $output = $json['output'] ?? [];
        if (!is_array($output)) return '';

        foreach ($output as $item) {
            $content = $item['content'] ?? [];
            if (!is_array($content)) continue;

            foreach ($content as $c) {
                if (($c['type'] ?? '') === 'output_text' && isset($c['text'])) {
                    $out .= (string)$c['text'] . "\n";
                }
            }
        }

        // иногда SDK возвращает output_text — но мы на него не полагаемся
        if (trim($out) === '' && isset($json['output_text'])) {
            $out = (string)$json['output_text'];
        }

        return $out;
    }

    private function extractRelevantContext(string $text, string $query, int $maxChars = 1800): string
    {
        $text = trim($text);
        if ($text === '') return '';

        $paras = preg_split("/\n\s*\n/u", $text) ?: [];
        $paras = array_values(array_filter(array_map('trim', $paras), fn($p) => mb_strlen($p) >= 40));

        if (count($paras) === 0) {
            return mb_substr($text, 0, $maxChars);
        }

        $q = mb_strtolower($query);
        $words = preg_split('/[^\p{L}\p{N}]+/u', $q) ?: [];
        $words = array_values(array_filter($words, fn($w) => mb_strlen($w) >= 4));
        $words = array_slice(array_unique($words), 0, 20);

        // Скорая эвристика: считаем совпадения слов
        $scored = [];
        foreach ($paras as $p) {
            $lp = mb_strtolower($p);
            $score = 0;
            foreach ($words as $w) {
                if ($w !== '' && mb_strpos($lp, $w) !== false) $score++;
            }
            $scored[] = ['p' => $p, 's' => $score];
        }

        usort($scored, fn($a, $b) => $b['s'] <=> $a['s']);

        $picked = [];
        foreach ($scored as $row) {
            if ($row['s'] <= 0 && count($picked) > 0) break;
            $picked[] = $row['p'];
            if (count($picked) >= 3) break;
        }

        if (count($picked) === 0) {
            $picked = array_slice($paras, 0, 2);
        }

        $ctx = implode("\n\n", $picked);

        if (mb_strlen($ctx) > $maxChars) {
            $ctx = mb_substr($ctx, 0, $maxChars) . '…';
        }

        return $ctx;
    }
}
