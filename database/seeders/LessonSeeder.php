<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        $lessons = array_merge(
            require __DIR__ . '/data/python_lessons.php',
            require __DIR__ . '/data/lessons_extended.php',
        );

        $i18n = require __DIR__ . '/data/content_i18n.php';
        $i18nExt = require __DIR__ . '/data/content_i18n_extended.php';

        foreach ($i18nExt['lessons'] ?? [] as $index => $pack) {
            $i18n['lessons'][$index] = $pack;
        }

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
