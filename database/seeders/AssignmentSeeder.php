<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Assignment;
use App\Models\Lesson;

class AssignmentSeeder extends Seeder
{
    public function run(): void
    {
        $lessons = Lesson::all();

        $assignmentData = [
            'Введение в Python' => [
                [
                    'title' => 'Установка Python и первая программа',
                    'description' => 'Установить Python и создать файл с командой print("Hello, World!")',
                ],
            ],
            'Переменные и типы данных' => [
                [
                    'title' => 'Работа с переменными',
                    'description' => 'Создать программу, которая демонстрирует основные типы данных в Python',
                ],
                [
                    'title' => 'Преобразование типов',
                    'description' => 'Написать примеры явного преобразования типов int(), str(), float()',
                ],
            ],
            'Условные операторы' => [
                [
                    'title' => 'If-else условия',
                    'description' => 'Написать программу с проверкой возраста пользователя',
                ],
                [
                    'title' => 'Множественные условия',
                    'description' => 'Создать калькулятор с использованием if/elif для операций',
                ],
            ],
            'Циклы' => [
                [
                    'title' => 'Таблица умножения',
                    'description' => 'Вывести таблицу умножения 9x9 используя вложенные циклы for',
                ],
                [
                    'title' => 'Поиск простых чисел',
                    'description' => 'Найти все простые числа от 1 до 100',
                ],
            ],
            'Функции' => [
                [
                    'title' => 'Создание функций',
                    'description' => 'Написать 5 функций для различных математических операций',
                ],
            ],
            'Списки и словари' => [
                [
                    'title' => 'Работа со списками',
                    'description' => 'Создать программу для обработки списка чисел (сумма, среднее, сортировка)',
                ],
            ],
            'Работа со строками' => [
                [
                    'title' => 'Обработка строк',
                    'description' => 'Написать программу для проверки корректности email с помощью строковых методов',
                ],
            ],
            'ООП в Python' => [
                [
                    'title' => 'Классы и объекты',
                    'description' => 'Создать класс Student с методами для установки и получения данных',
                ],
            ],
        ];

        foreach ($lessons as $lesson) {
            if (isset($assignmentData[$lesson->title])) {
                foreach ($assignmentData[$lesson->title] as $assignment) {
                    Assignment::create([
                        'lesson_id' => $lesson->id,
                        'title' => $assignment['title'],
                        'description' => $assignment['description'],
                    ]);
                }
            }
        }
    }
}
