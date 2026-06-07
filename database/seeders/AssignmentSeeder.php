<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\Lesson;
use Illuminate\Database\Seeder;

class AssignmentSeeder extends Seeder
{
    public function run(): void
    {
        $i18n = require __DIR__ . '/data/content_i18n.php';
        $i18nExt = require __DIR__ . '/data/content_i18n_extended.php';

        foreach ($i18nExt['assignments'] ?? [] as $index => $pack) {
            $i18n['assignments'][$index] = $pack;
        }

        $assignmentData = array_merge([
            [
                ['title' => 'Python орнату және бірінші бағдарлама', 'description' => 'Python орнатып, print("Hello, World!") командасы бар файл жасаңыз'],
            ],
            [
                ['title' => 'Айнымалылармен жұмыс', 'description' => 'Python-дағы негізгі деректер типтерін көрсететін бағдарлама жазыңыз'],
                ['title' => 'Типтерді түрлендіру', 'description' => 'int(), str(), float() функцияларының мысалдарын жазыңыз'],
            ],
            [
                ['title' => 'If-else шарттары', 'description' => 'Пайдаланушы жasын тексеретін бағдарлама жазыңыз'],
                ['title' => 'Көп шарттар', 'description' => 'if/elif арқылы операциялар бар калькулятор жасаңыз'],
            ],
            [
                ['title' => 'Көбейтінді кесте', 'description' => 'for циклдерімен 9x9 көбейтінді кестесін шығарыңыз'],
                ['title' => 'Жай сандарды табу', 'description' => '1-ден 100-ге дейінгі барлық жай сандарды табыңыз'],
            ],
            [
                ['title' => 'Функциялар жасау', 'description' => 'Әртүрлі математикалық операцияларға 5 функция жазыңыз'],
            ],
            [
                ['title' => 'Тізімдермен жұмыс', 'description' => 'Сандар тізімін өңдейтін бағдарлама жазыңыз (қосынды, орта, сорттау)'],
            ],
            [
                ['title' => 'Жолдарды өңдеу', 'description' => 'Жол әдістері арқылы email дұрыстығын тексеретін бағдарлама жазыңыз'],
            ],
            [
                ['title' => 'Класстар мен объектілер', 'description' => 'Student классын деректерді орнату/алу әдістерімен жасаңыз'],
            ],
        ], require __DIR__ . '/data/assignments_extended.php');

        foreach (Lesson::orderBy('id')->get() as $lessonIndex => $lesson) {
            if (! isset($assignmentData[$lessonIndex])) {
                continue;
            }

            $i18nAssignments = $i18n['assignments'][$lessonIndex] ?? [];

            foreach ($assignmentData[$lessonIndex] as $aIndex => $assignment) {
                $pack = [
                    'kk' => [
                        'title' => $assignment['title'],
                        'description' => $assignment['description'],
                    ],
                ];

                if (isset($i18nAssignments[$aIndex]['ru'])) {
                    $pack['ru'] = $i18nAssignments[$aIndex]['ru'];
                }
                if (isset($i18nAssignments[$aIndex]['en'])) {
                    $pack['en'] = $i18nAssignments[$aIndex]['en'];
                }

                Assignment::create([
                    'lesson_id' => $lesson->id,
                    'title' => $assignment['title'],
                    'description' => $assignment['description'],
                    'translations' => $pack,
                ]);
            }
        }
    }
}
