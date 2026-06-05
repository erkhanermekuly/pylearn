<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        $lessons = [
            [
                'title' => 'Введение в Python',
                'content' => 'Основные концепции языка Python. История создания, область применения, установка интерпретатора и первая программа print("Hello, World!").',
            ],
            [
                'title' => 'Переменные и типы данных',
                'content' => 'Объявление переменных, основные типы данных в Python (int, float, str, bool), преобразование типов, константы.',
            ],
            [
                'title' => 'Условные операторы',
                'content' => 'if, elif, else. Логические операторы and, or, not. Тернарный оператор.',
            ],
            [
                'title' => 'Циклы',
                'content' => 'Циклы for и while. Управление циклом: break, continue. Функция range().',
            ],
            [
                'title' => 'Функции',
                'content' => 'Объявление функций def, параметры, возвращаемые значения, область видимости переменных.',
            ],
            [
                'title' => 'Списки и словари',
                'content' => 'Списки list, словари dict, кортежи tuple, множества set. Основные методы и операции.',
            ],
            [
                'title' => 'Работа со строками',
                'content' => 'Операции со строками, форматирование f-strings, основные строковые методы.',
            ],
            [
                'title' => 'ООП в Python',
                'content' => 'Классы и объекты, конструктор __init__, свойства и методы, наследование.',
            ],
        ];

        foreach ($lessons as $lesson) {
            Lesson::create([
                'title' => $lesson['title'],
                'content' => $lesson['content'],
                'pdf_path' => null,
            ]);
        }
    }
}
