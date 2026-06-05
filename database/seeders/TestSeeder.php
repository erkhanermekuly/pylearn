<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\Test;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    public function run(): void
    {
        $testData = require __DIR__ . '/data/python_tests.php';
        $i18n = require __DIR__ . '/data/content_i18n.php';

        $lessonTitles = array_keys($testData);

        foreach (Lesson::orderBy('id')->get() as $index => $lesson) {
            if (! isset($testData[$lesson->title])) {
                continue;
            }

            $questions = $testData[$lesson->title];
            $i18nTest = $i18n['tests'][$index] ?? [];

            $pack = [
                'kk' => [
                    'title' => 'Сынақ: ' . $lesson->title,
                    'questions' => $questions,
                ],
            ];

            if (isset($i18nTest['ru'])) {
                $pack['ru'] = $i18nTest['ru'];
            }
            if (isset($i18nTest['en'])) {
                $pack['en'] = $i18nTest['en'];
            }

            Test::create([
                'lesson_id' => $lesson->id,
                'title' => 'Сынақ: ' . $lesson->title,
                'questions' => $questions,
                'translations' => $pack,
            ]);
        }
    }
}
