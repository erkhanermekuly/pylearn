<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Test;
use App\Models\Lesson;

class TestSeeder extends Seeder
{
    public function run(): void
    {
        $lessons = Lesson::all();

        $testData = [
            'Введение в Python' => [
                'title' => 'Тест: Введение в Python',
                'questions' => [
                    [
                        'text' => 'Что такое Python?',
                        'options' => ['Язык программирования общего назначения', 'Операционная система', 'База данных', 'Веб-браузер'],
                        'correct' => 0,
                    ],
                    [
                        'text' => 'Кто создал Python?',
                        'options' => ['Гвидо ван Россум', 'Деннис Ритчи', 'Джеймс Гослинг', 'Бьёрн Страуструп'],
                        'correct' => 0,
                    ],
                ],
            ],
            'Переменные и типы данных' => [
                'title' => 'Тест: Переменные и типы данных',
                'questions' => [
                    [
                        'text' => 'Как объявить переменную в Python?',
                        'options' => ['name = "Python"', 'var name', 'declare name', 'variable name'],
                        'correct' => 0,
                    ],
                    [
                        'text' => 'Какой тип у значения 3.14 в Python?',
                        'options' => ['int', 'float', 'str', 'bool'],
                        'correct' => 1,
                    ],
                ],
            ],
            'Условные операторы' => [
                'title' => 'Тест: Условные операторы',
                'questions' => [
                    [
                        'text' => 'Что выведет: print("да" if 5 > 3 else "нет")',
                        'options' => ['да', 'нет', 'True', 'Ошибка'],
                        'correct' => 0,
                    ],
                ],
            ],
            'Циклы' => [
                'title' => 'Тест: Циклы',
                'questions' => [
                    [
                        'text' => 'Какой цикл чаще используют для перебора элементов списка?',
                        'options' => ['while', 'for', 'do-while', 'loop'],
                        'correct' => 1,
                    ],
                ],
            ],
            'Функции' => [
                'title' => 'Тест: Функции',
                'questions' => [
                    [
                        'text' => 'Как объявить функцию в Python?',
                        'options' => ['def my_func():', 'function myFunc()', 'func myFunc()', 'fn myFunc()'],
                        'correct' => 0,
                    ],
                ],
            ],
        ];

        foreach ($lessons as $lesson) {
            if (isset($testData[$lesson->title])) {
                $test = $testData[$lesson->title];
                Test::create([
                    'lesson_id' => $lesson->id,
                    'title' => $test['title'],
                    'questions' => $test['questions'],
                ]);
            }
        }
    }
}
