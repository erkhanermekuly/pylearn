<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        $lessons = require __DIR__ . '/data/python_lessons.php';
        $i18n = require __DIR__ . '/data/content_i18n.php';

        foreach ($lessons as $index => $lesson) {
            $localePack = $i18n['lessons'][$index] ?? [];

            Lesson::create([
                'title' => $lesson['title'],
                'content' => $lesson['content'],
                'pdf_path' => null,
                'translations' => array_merge($localePack, [
                    'kk' => [
                        'title' => $lesson['title'],
                        'content' => $lesson['content'],
                    ],
                ]),
            ]);
        }
    }
}
