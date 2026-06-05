<?php

return array (
  'lessons' => 
  array (
    0 => 
    array (
      'ru' => 
      array (
        'title' => 'Введение в Python',
        'content' => 'Python — язык программирования высокого уровня общего назначения. Создан Гвидо ван Россумом, первая версия вышла в 1991 году. Python используется в веб-разработке, анализе данных, машинном обучении, автоматизации и научных вычислениях.

Почему Python популярен:
• Простой и понятный синтаксис — код похож на обычный текст
• Большая стандартная библиотека — много готовых инструментов
• Активное сообщество и множество пакетов (pip)
• Кроссплатформенность — работает на Windows, macOS, Linux

Установка:
1. Скачайте Python с python.org (рекомендуем 3.10+)
2. При установке отметьте «Add Python to PATH»
3. Проверьте: python --version

Первая программа:
print("Hello, World!")

Функция print() выводит текст на экран. В Python строки заключаются в " или \'.

Интерактивный режим (REPL):
В терминале запустите python — можно вводить команды построчно и сразу видеть результат.

Код сохраняется в файлы с расширением .py. Запуск: python main.py

Комментарии начинаются с # и игнорируются интерпретатором.
Отступы в Python важны — они определяют блоки кода (обычно 4 пробела).',
      ),
      'en' => 
      array (
        'title' => 'Introduction to Python',
        'content' => 'Python is a high-level general-purpose programming language created by Guido van Rossum; the first version was released in 1991. Python is used in web development, data analysis, machine learning, automation, and scientific computing.

Why Python is popular:
• Simple, readable syntax
• Large standard library and pip packages
• Active community
• Cross-platform: Windows, macOS, Linux

Installation:
1. Download Python from python.org (3.10+ recommended)
2. Check "Add Python to PATH" during install
3. Verify: python --version

First program:
print("Hello, World!")

The print() function outputs text. Strings use " or \' quotes.

Interactive REPL: run python in the terminal.

Save code as .py files. Run: python main.py

Comments start with #. Indentation (usually 4 spaces) defines code blocks.',
      ),
    ),
    1 => 
    array (
      'ru' => 
      array (
        'title' => 'Переменные и типы данных',
        'content' => 'Переменная — именованная область памяти для хранения данных. В Python не нужно заранее объявлять тип:

name = "Асхат"
age = 17
height = 1.75
is_student = True

Основные типы данных:
• int — целые числа
• float — дробные числа
• str — строки
• bool — логические значения True, False

Проверка типа: type(x)

Преобразование типов: int("42"), float("3.14"), str(100), bool(0)

Имена переменных: буквы, цифры, _, не начинаются с цифры. Регистр важен.

Множественное присваивание: a, b, c = 1, 2, 3

Операторы: + - * / // % **
input() читает строку с клавиатуры.',
      ),
      'en' => 
      array (
        'title' => 'Variables and Data Types',
        'content' => 'A variable stores data. Python does not require explicit type declarations:

name = "Askar"
age = 17
height = 1.75
is_student = True

Basic types: int, float, str, bool
Type check: type(x)
Type conversion: int(), float(), str(), bool()
Variable names: letters, digits, underscore; case-sensitive.

Multiple assignment: a, b, c = 1, 2, 3
Operators: + - * / // % **
input() reads a line from the keyboard.',
      ),
    ),
    2 => 
    array (
      'ru' => 
      array (
        'title' => 'Условные операторы',
        'content' => 'Условные операторы позволяют выполнять код только при выполнении условия.

if — если:
if age >= 18:
    print("Взрослый")
else:
    print("Несовершеннолетний")

elif — иначе если

Логические операторы: and, or, not
Сравнение: == != < > <= >=
Важно: == проверяет равенство, = присваивает значение!

Тернарный оператор: result = "да" if x > 0 else "нет"

Truthy и Falsy: False, 0, "", [], {}, None — ложные в условии.',
      ),
      'en' => 
      array (
        'title' => 'Conditional Operators',
        'content' => 'Conditional statements run code only when a condition is true.

if / elif / else
Logical operators: and, or, not
Comparison: == != < > <= >=
Note: == tests equality, = assigns a value!

Ternary: result = "yes" if x > 0 else "no"

Truthy/Falsy: False, 0, "", [], {}, None are falsy.',
      ),
    ),
    3 => 
    array (
      'ru' => 
      array (
        'title' => 'Циклы',
        'content' => 'Циклы повторяют блок кода несколько раз.

for — обход последовательности:
for i in range(5):
    print(i)

range(start, stop, step)

while — пока условие True:
count = 0
while count < 5:
    print(count)
    count += 1

break — выход из цикла
continue — переход к следующей итерации

enumerate() — индекс и элемент вместе.',
      ),
      'en' => 
      array (
        'title' => 'Loops',
        'content' => 'Loops repeat a block of code.

for i in range(5):
    print(i)

range(start, stop, step)

while condition:
    ...

break exits the loop; continue skips to the next iteration.
enumerate() yields index and item pairs.',
      ),
    ),
    4 => 
    array (
      'ru' => 
      array (
        'title' => 'Функции',
        'content' => 'Функция — именованный блок кода, который можно вызывать многократно.

def greet(name):
    return f"Привет, {name}!"

Параметры и аргументы, значения по умолчанию, *args, **kwargs
lambda — короткая анонимная функция

Локальные и глобальные переменные, docstring, рекурсия.',
      ),
      'en' => 
      array (
        'title' => 'Functions',
        'content' => 'A function is a named reusable block of code.

def greet(name):
    return f"Hello, {name}!"

Default parameters, *args, **kwargs, lambda functions.
Local vs global scope, docstrings, recursion.',
      ),
    ),
    5 => 
    array (
      'ru' => 
      array (
        'title' => 'Списки и словари',
        'content' => 'Список (list) — упорядоченная изменяемая коллекция:
fruits = ["яблоко", "банан", "апельсин"]

Методы: append, insert, remove, pop, sort, len

List comprehension: [x**2 for x in range(10)]

Словарь (dict) — пары ключ:значение:
student = {"name": "Асхат", "age": 17}

Кортеж (tuple) — неизменяемый список
Множество (set) — уникальные элементы',
      ),
      'en' => 
      array (
        'title' => 'Lists and Dictionaries',
        'content' => 'list — ordered mutable collection: fruits = ["apple", "banana"]
Methods: append, insert, remove, pop, sort, len
List comprehension: [x**2 for x in range(10)]

dict — key:value pairs: student = {"name": "Askar", "age": 17}
tuple — immutable sequence; set — unique elements',
      ),
    ),
    6 => 
    array (
      'ru' => 
      array (
        'title' => 'Работа со строками',
        'content' => 'Строка (str) — последовательность символов в Python.

f-строки: f"Меня зовут {name}, мне {age} лет"

Методы: .upper(), .lower(), .strip(), .split(), .replace(), .startswith(), .join()
in — проверка вхождения
Экранирование: \\n, \\t, \\"',
      ),
      'en' => 
      array (
        'title' => 'Working with Strings',
        'content' => 'str — sequence of characters.

f-strings: f"My name is {name}, I am {age}"
Methods: upper, lower, strip, split, replace, startswith, join
Membership: "Py" in "Python"
Escapes: \\n, \\t, \\"',
      ),
    ),
    7 => 
    array (
      'ru' => 
      array (
        'title' => 'ООП в Python',
        'content' => 'ООП — объектно-ориентированное программирование на основе классов и объектов.

class Dog:
    def __init__(self, name, age):
        self.name = name
        self.age = age

    def bark(self):
        return f"{self.name} говорит: Гав!"

Наследование, переопределение методов, super().__init__()
Инкапсуляция, @property, @staticmethod, @classmethod, __str__',
      ),
      'en' => 
      array (
        'title' => 'OOP in Python',
        'content' => 'OOP — object-oriented programming with classes and objects.

class Dog:
    def __init__(self, name, age):
        self.name = name
        self.age = age

    def bark(self):
        return f"{self.name} says: Woof!"

Inheritance, method overriding, super().__init__()
Encapsulation, @property, @staticmethod, @classmethod, __str__',
      ),
    ),
  ),
  'tests' => 
  array (
    0 => 
    array (
      'ru' => 
      array (
        'title' => 'Тест: Введение в Python',
        'questions' => 
        array (
          0 => 
          array (
            'text' => 'Что такое Python?',
            'options' => 
            array (
              0 => 'Язык программирования общего назначения',
              1 => 'Операционная система',
              2 => 'База данных',
              3 => 'Графический редактор',
            ),
            'correct' => 0,
          ),
          1 => 
          array (
            'text' => 'Кто создал Python?',
            'options' => 
            array (
              0 => 'Гвидо ван Россум',
              1 => 'Деннис Ритчи',
              2 => 'Джеймс Гослинг',
              3 => 'Бьёрн Страуструп',
            ),
            'correct' => 0,
          ),
          2 => 
          array (
            'text' => 'Какое расширение у файла Python?',
            'options' => 
            array (
              0 => '.py',
              1 => '.python',
              2 => '.pt',
              3 => '.code',
            ),
            'correct' => 0,
          ),
          3 => 
          array (
            'text' => 'Какая функция выводит текст на экран?',
            'options' => 
            array (
              0 => 'print()',
              1 => 'echo()',
              2 => 'output()',
              3 => 'show()',
            ),
            'correct' => 0,
          ),
          4 => 
          array (
            'text' => 'Как начинается однострочный комментарий в Python?',
            'options' => 
            array (
              0 => '#',
              1 => '//',
              2 => '/*',
              3 => '--',
            ),
            'correct' => 0,
          ),
          5 => 
          array (
            'text' => 'Как запустить main.py из терминала?',
            'options' => 
            array (
              0 => 'python main.py',
              1 => 'run main.py',
              2 => 'exec main.py',
              3 => 'start main.py',
            ),
            'correct' => 0,
          ),
          6 => 
          array (
            'text' => 'Когда вышла первая версия Python?',
            'options' => 
            array (
              0 => '1991',
              1 => '2000',
              2 => '1985',
              3 => '2010',
            ),
            'correct' => 0,
          ),
          7 => 
          array (
            'text' => 'Что такое REPL в Python?',
            'options' => 
            array (
              0 => 'Интерактивный режим интерпретатора',
              1 => 'Редактор кода',
              2 => 'Менеджер пакетов',
              3 => 'Компилятор',
            ),
            'correct' => 0,
          ),
          8 => 
          array (
            'text' => 'Какой инструмент устанавливает пакеты Python?',
            'options' => 
            array (
              0 => 'pip',
              1 => 'npm',
              2 => 'composer',
              3 => 'gem',
            ),
            'correct' => 0,
          ),
          9 => 
          array (
            'text' => 'Сколько пробелов рекомендуется для отступа?',
            'options' => 
            array (
              0 => '4',
              1 => '2',
              2 => '8',
              3 => 'Только табуляция',
            ),
            'correct' => 0,
          ),
        ),
      ),
      'en' => 
      array (
        'title' => 'Test: Introduction to Python',
        'questions' => 
        array (
          0 => 
          array (
            'text' => 'What is Python?',
            'options' => 
            array (
              0 => 'A general-purpose programming language',
              1 => 'An operating system',
              2 => 'A database',
              3 => 'A graphics editor',
            ),
            'correct' => 0,
          ),
          1 => 
          array (
            'text' => 'Who created Python?',
            'options' => 
            array (
              0 => 'Guido van Rossum',
              1 => 'Dennis Ritchie',
              2 => 'James Gosling',
              3 => 'Bjarne Stroustrup',
            ),
            'correct' => 0,
          ),
          2 => 
          array (
            'text' => 'What is the Python file extension?',
            'options' => 
            array (
              0 => '.py',
              1 => '.python',
              2 => '.pt',
              3 => '.code',
            ),
            'correct' => 0,
          ),
          3 => 
          array (
            'text' => 'Which function prints text to the screen?',
            'options' => 
            array (
              0 => 'print()',
              1 => 'echo()',
              2 => 'output()',
              3 => 'show()',
            ),
            'correct' => 0,
          ),
          4 => 
          array (
            'text' => 'How does a one-line comment start in Python?',
            'options' => 
            array (
              0 => '#',
              1 => '//',
              2 => '/*',
              3 => '--',
            ),
            'correct' => 0,
          ),
          5 => 
          array (
            'text' => 'How do you run main.py from the terminal?',
            'options' => 
            array (
              0 => 'python main.py',
              1 => 'run main.py',
              2 => 'exec main.py',
              3 => 'start main.py',
            ),
            'correct' => 0,
          ),
          6 => 
          array (
            'text' => 'When was the first version of Python released?',
            'options' => 
            array (
              0 => '1991',
              1 => '2000',
              2 => '1985',
              3 => '2010',
            ),
            'correct' => 0,
          ),
          7 => 
          array (
            'text' => 'What is the Python REPL?',
            'options' => 
            array (
              0 => 'Interactive interpreter mode',
              1 => 'Code editor',
              2 => 'Package manager',
              3 => 'Compiler',
            ),
            'correct' => 0,
          ),
          8 => 
          array (
            'text' => 'Which tool installs Python packages?',
            'options' => 
            array (
              0 => 'pip',
              1 => 'npm',
              2 => 'composer',
              3 => 'gem',
            ),
            'correct' => 0,
          ),
          9 => 
          array (
            'text' => 'How many spaces are recommended for indentation?',
            'options' => 
            array (
              0 => '4',
              1 => '2',
              2 => '8',
              3 => 'Tabs only',
            ),
            'correct' => 0,
          ),
        ),
      ),
    ),
    1 => 
    array (
      'ru' => 
      array (
        'title' => 'Тест: Переменные и типы данных',
        'questions' => 
        array (
          0 => 
          array (
            'text' => 'Как объявить переменную в Python?',
            'options' => 
            array (
              0 => 'name = "Python"',
              1 => 'var name = "Python"',
              2 => 'declare name',
              3 => 'string name',
            ),
            'correct' => 0,
          ),
          1 => 
          array (
            'text' => 'Какой тип у значения 3.14?',
            'options' => 
            array (
              0 => 'float',
              1 => 'int',
              2 => 'str',
              3 => 'decimal',
            ),
            'correct' => 0,
          ),
          2 => 
          array (
            'text' => 'Какой тип у значения True?',
            'options' => 
            array (
              0 => 'bool',
              1 => 'int',
              2 => 'str',
              3 => 'NoneType',
            ),
            'correct' => 0,
          ),
          3 => 
          array (
            'text' => 'Как преобразовать "42" в число?',
            'options' => 
            array (
              0 => 'int("42")',
              1 => 'number("42")',
              2 => 'toInt("42")',
              3 => 'parse("42")',
            ),
            'correct' => 0,
          ),
          4 => 
          array (
            'text' => 'Что возвращает type(5)?',
            'options' => 
            array (
              0 => '<class \'int\'>',
              1 => '<class \'float\'>',
              2 => '<class \'str\'>',
              3 => 'int',
            ),
            'correct' => 0,
          ),
          5 => 
          array (
            'text' => 'Что делает оператор //?',
            'options' => 
            array (
              0 => 'Целочисленное деление',
              1 => 'Обычное деление',
              2 => 'Возведение в степень',
              3 => 'Остаток',
            ),
            'correct' => 0,
          ),
          6 => 
          array (
            'text' => 'Результат "Ha" * 3?',
            'options' => 
            array (
              0 => 'HaHaHa',
              1 => 'Ha3',
              2 => 'Ha Ha Ha',
              3 => 'Ошибка',
            ),
            'correct' => 0,
          ),
          7 => 
          array (
            'text' => 'Какое имя переменной корректно?',
            'options' => 
            array (
              0 => 'user_name',
              1 => '2name',
              2 => 'user-name',
              3 => 'class',
            ),
            'correct' => 0,
          ),
          8 => 
          array (
            'text' => 'Что возвращает bool(0)?',
            'options' => 
            array (
              0 => 'False',
              1 => 'True',
              2 => '0',
              3 => 'None',
            ),
            'correct' => 0,
          ),
          9 => 
          array (
            'text' => 'Как прочитать ввод пользователя?',
            'options' => 
            array (
              0 => 'input()',
              1 => 'read()',
              2 => 'scan()',
              3 => 'get()',
            ),
            'correct' => 0,
          ),
        ),
      ),
      'en' => 
      array (
        'title' => 'Test: Variables and Data Types',
        'questions' => 
        array (
          0 => 
          array (
            'text' => 'How do you declare a variable in Python?',
            'options' => 
            array (
              0 => 'name = "Python"',
              1 => 'var name = "Python"',
              2 => 'declare name',
              3 => 'string name',
            ),
            'correct' => 0,
          ),
          1 => 
          array (
            'text' => 'What type is 3.14?',
            'options' => 
            array (
              0 => 'float',
              1 => 'int',
              2 => 'str',
              3 => 'decimal',
            ),
            'correct' => 0,
          ),
          2 => 
          array (
            'text' => 'What type is True?',
            'options' => 
            array (
              0 => 'bool',
              1 => 'int',
              2 => 'str',
              3 => 'NoneType',
            ),
            'correct' => 0,
          ),
          3 => 
          array (
            'text' => 'How do you convert "42" to a number?',
            'options' => 
            array (
              0 => 'int("42")',
              1 => 'number("42")',
              2 => 'toInt("42")',
              3 => 'parse("42")',
            ),
            'correct' => 0,
          ),
          4 => 
          array (
            'text' => 'What does type(5) return?',
            'options' => 
            array (
              0 => '<class \'int\'>',
              1 => '<class \'float\'>',
              2 => '<class \'str\'>',
              3 => 'int',
            ),
            'correct' => 0,
          ),
          5 => 
          array (
            'text' => 'What does // do?',
            'options' => 
            array (
              0 => 'Floor division',
              1 => 'Regular division',
              2 => 'Exponentiation',
              3 => 'Remainder',
            ),
            'correct' => 0,
          ),
          6 => 
          array (
            'text' => 'What is "Ha" * 3?',
            'options' => 
            array (
              0 => 'HaHaHa',
              1 => 'Ha3',
              2 => 'Ha Ha Ha',
              3 => 'Error',
            ),
            'correct' => 0,
          ),
          7 => 
          array (
            'text' => 'Which variable name is valid?',
            'options' => 
            array (
              0 => 'user_name',
              1 => '2name',
              2 => 'user-name',
              3 => 'class',
            ),
            'correct' => 0,
          ),
          8 => 
          array (
            'text' => 'What does bool(0) return?',
            'options' => 
            array (
              0 => 'False',
              1 => 'True',
              2 => '0',
              3 => 'None',
            ),
            'correct' => 0,
          ),
          9 => 
          array (
            'text' => 'How do you read user input?',
            'options' => 
            array (
              0 => 'input()',
              1 => 'read()',
              2 => 'scan()',
              3 => 'get()',
            ),
            'correct' => 0,
          ),
        ),
      ),
    ),
    2 => 
    array (
      'ru' => 
      array (
        'title' => 'Тест: Условные операторы',
        'questions' => 
        array (
          0 => 
          array (
            'text' => 'Какой оператор используется для «иначе если»?',
            'options' => 
            array (
              0 => 'elif',
              1 => 'elseif',
              2 => 'else if',
              3 => 'then',
            ),
            'correct' => 0,
          ),
          1 => 
          array (
            'text' => 'Что выведет print("да" if 5 > 3 else "нет")?',
            'options' => 
            array (
              0 => 'да',
              1 => 'нет',
              2 => 'True',
              3 => '5 > 3',
            ),
            'correct' => 0,
          ),
          2 => 
          array (
            'text' => 'Логический оператор «И»?',
            'options' => 
            array (
              0 => 'and',
              1 => 'or',
              2 => 'not',
              3 => '&&',
            ),
            'correct' => 0,
          ),
          3 => 
          array (
            'text' => 'Разница между == и =?',
            'options' => 
            array (
              0 => '== сравнивает, = присваивает',
              1 => 'Одинаковы',
              2 => '= сравнивает, == присваивает',
              3 => '== только для строк',
            ),
            'correct' => 0,
          ),
          4 => 
          array (
            'text' => 'Какое значение ложное (Falsy)?',
            'options' => 
            array (
              0 => '0',
              1 => '1',
              2 => '"hello"',
              3 => '[1, 2]',
            ),
            'correct' => 0,
          ),
          5 => 
          array (
            'text' => 'Что делает not?',
            'options' => 
            array (
              0 => 'Инвертирует логическое значение',
              1 => 'Проверяет неравенство',
              2 => 'Отрицает число',
              3 => 'Удаляет переменную',
            ),
            'correct' => 0,
          ),
          6 => 
          array (
            'text' => 'Сколько else может быть у одного if?',
            'options' => 
            array (
              0 => 'Один',
              1 => 'Два',
              2 => 'Бесконечно',
              3 => 'Ни одного',
            ),
            'correct' => 0,
          ),
          7 => 
          array (
            'text' => 'Результат print(10 > 5 and 3 < 2)?',
            'options' => 
            array (
              0 => 'False',
              1 => 'True',
              2 => '10',
              3 => 'Ошибка',
            ),
            'correct' => 0,
          ),
          8 => 
          array (
            'text' => 'x если x > 0, иначе -1 — как записать?',
            'options' => 
            array (
              0 => 'x if x > 0 else -1',
              1 => 'if x > 0 then x else -1',
              2 => 'x ? 0 : -1',
              3 => 'when x > 0: x',
            ),
            'correct' => 0,
          ),
          9 => 
          array (
            'text' => 'Оператор «не равно»?',
            'options' => 
            array (
              0 => '!=',
              1 => '<>',
              2 => '=/=',
              3 => '!==',
            ),
            'correct' => 0,
          ),
        ),
      ),
      'en' => 
      array (
        'title' => 'Test: Conditional Operators',
        'questions' => 
        array (
          0 => 
          array (
            'text' => 'Which keyword is used for "else if"?',
            'options' => 
            array (
              0 => 'elif',
              1 => 'elseif',
              2 => 'else if',
              3 => 'then',
            ),
            'correct' => 0,
          ),
          1 => 
          array (
            'text' => 'What does print("yes" if 5 > 3 else "no") output?',
            'options' => 
            array (
              0 => 'yes',
              1 => 'no',
              2 => 'True',
              3 => '5 > 3',
            ),
            'correct' => 0,
          ),
          2 => 
          array (
            'text' => 'Logical AND operator?',
            'options' => 
            array (
              0 => 'and',
              1 => 'or',
              2 => 'not',
              3 => '&&',
            ),
            'correct' => 0,
          ),
          3 => 
          array (
            'text' => 'Difference between == and =?',
            'options' => 
            array (
              0 => '== compares, = assigns',
              1 => 'They are the same',
              2 => '= compares, == assigns',
              3 => '== is only for strings',
            ),
            'correct' => 0,
          ),
          4 => 
          array (
            'text' => 'Which value is falsy?',
            'options' => 
            array (
              0 => '0',
              1 => '1',
              2 => '"hello"',
              3 => '[1, 2]',
            ),
            'correct' => 0,
          ),
          5 => 
          array (
            'text' => 'What does not do?',
            'options' => 
            array (
              0 => 'Inverts a boolean value',
              1 => 'Checks inequality',
              2 => 'Negates a number',
              3 => 'Deletes a variable',
            ),
            'correct' => 0,
          ),
          6 => 
          array (
            'text' => 'How many else blocks can one if have?',
            'options' => 
            array (
              0 => 'One',
              1 => 'Two',
              2 => 'Unlimited',
              3 => 'None',
            ),
            'correct' => 0,
          ),
          7 => 
          array (
            'text' => 'Result of print(10 > 5 and 3 < 2)?',
            'options' => 
            array (
              0 => 'False',
              1 => 'True',
              2 => '10',
              3 => 'Error',
            ),
            'correct' => 0,
          ),
          8 => 
          array (
            'text' => 'x if x > 0 else -1 — how to write it?',
            'options' => 
            array (
              0 => 'x if x > 0 else -1',
              1 => 'if x > 0 then x else -1',
              2 => 'x ? 0 : -1',
              3 => 'when x > 0: x',
            ),
            'correct' => 0,
          ),
          9 => 
          array (
            'text' => 'Not-equal operator?',
            'options' => 
            array (
              0 => '!=',
              1 => '<>',
              2 => '=/=',
              3 => '!==',
            ),
            'correct' => 0,
          ),
        ),
      ),
    ),
    3 => 
    array (
      'ru' => 
      array (
        'title' => 'Тест: Циклы',
        'questions' => 
        array (
          0 => 
          array (
            'text' => 'Какой цикл часто используют для обхода списка?',
            'options' => 
            array (
              0 => 'for',
              1 => 'while',
              2 => 'do-while',
              3 => 'loop',
            ),
            'correct' => 0,
          ),
          1 => 
          array (
            'text' => 'Что генерирует range(5)?',
            'options' => 
            array (
              0 => '0, 1, 2, 3, 4',
              1 => '1, 2, 3, 4, 5',
              2 => '5 нулей',
              3 => 'Строку длиной 5',
            ),
            'correct' => 0,
          ),
          2 => 
          array (
            'text' => 'Что делает break в цикле?',
            'options' => 
            array (
              0 => 'Останавливает цикл',
              1 => 'Пропускает итерацию',
              2 => 'Перезапускает цикл',
              3 => 'Вызывает ошибку',
            ),
            'correct' => 0,
          ),
          3 => 
          array (
            'text' => 'Что делает continue?',
            'options' => 
            array (
              0 => 'Переходит к следующей итерации',
              1 => 'Завершает программу',
              2 => 'Выходит из цикла',
              3 => 'Повторяет итерацию',
            ),
            'correct' => 0,
          ),
          4 => 
          array (
            'text' => 'Результат list(range(2, 6))?',
            'options' => 
            array (
              0 => '[2, 3, 4, 5]',
              1 => '[2, 3, 4, 5, 6]',
              2 => '[1, 2, 3, 4, 5]',
              3 => '[2, 6]',
            ),
            'correct' => 0,
          ),
          5 => 
          array (
            'text' => 'Когда выполняется else у цикла for?',
            'options' => 
            array (
              0 => 'Если не было break',
              1 => 'Всегда',
              2 => 'Только при ошибке',
              3 => 'Никогда',
            ),
            'correct' => 0,
          ),
          6 => 
          array (
            'text' => 'Что возвращает enumerate(["a", "b"])?',
            'options' => 
            array (
              0 => 'Пары (индекс, элемент)',
              1 => 'Количество элементов',
              2 => 'Сортирует список',
              3 => 'Объединяет списки',
            ),
            'correct' => 0,
          ),
          7 => 
          array (
            'text' => 'range(0, 10, 2) генерирует:',
            'options' => 
            array (
              0 => '0, 2, 4, 6, 8',
              1 => '0, 1, 2, ..., 9',
              2 => '2, 4, 6, 8, 10',
              3 => '0, 10',
            ),
            'correct' => 0,
          ),
          8 => 
          array (
            'text' => 'Если число итераций неизвестно, какой цикл лучше?',
            'options' => 
            array (
              0 => 'while',
              1 => 'for',
              2 => 'foreach',
              3 => 'repeat',
            ),
            'correct' => 0,
          ),
          9 => 
          array (
            'text' => 'Сколько раз выполнится for i in range(3): print(i)?',
            'options' => 
            array (
              0 => '3',
              1 => '2',
              2 => '4',
              3 => '1',
            ),
            'correct' => 0,
          ),
        ),
      ),
      'en' => 
      array (
        'title' => 'Test: Loops',
        'questions' => 
        array (
          0 => 
          array (
            'text' => 'Which loop is often used to iterate a list?',
            'options' => 
            array (
              0 => 'for',
              1 => 'while',
              2 => 'do-while',
              3 => 'loop',
            ),
            'correct' => 0,
          ),
          1 => 
          array (
            'text' => 'What does range(5) generate?',
            'options' => 
            array (
              0 => '0, 1, 2, 3, 4',
              1 => '1, 2, 3, 4, 5',
              2 => '5 zeros',
              3 => 'A string of length 5',
            ),
            'correct' => 0,
          ),
          2 => 
          array (
            'text' => 'What does break do in a loop?',
            'options' => 
            array (
              0 => 'Stops the loop',
              1 => 'Skips the iteration',
              2 => 'Restarts the loop',
              3 => 'Raises an error',
            ),
            'correct' => 0,
          ),
          3 => 
          array (
            'text' => 'What does continue do?',
            'options' => 
            array (
              0 => 'Goes to the next iteration',
              1 => 'Ends the program',
              2 => 'Exits the loop',
              3 => 'Repeats the iteration',
            ),
            'correct' => 0,
          ),
          4 => 
          array (
            'text' => 'Result of list(range(2, 6))?',
            'options' => 
            array (
              0 => '[2, 3, 4, 5]',
              1 => '[2, 3, 4, 5, 6]',
              2 => '[1, 2, 3, 4, 5]',
              3 => '[2, 6]',
            ),
            'correct' => 0,
          ),
          5 => 
          array (
            'text' => 'When does a for-else block run?',
            'options' => 
            array (
              0 => 'If break was not used',
              1 => 'Always',
              2 => 'Only on error',
              3 => 'Never',
            ),
            'correct' => 0,
          ),
          6 => 
          array (
            'text' => 'What does enumerate(["a", "b"]) return?',
            'options' => 
            array (
              0 => '(index, item) pairs',
              1 => 'Item count',
              2 => 'Sorted list',
              3 => 'Merged lists',
            ),
            'correct' => 0,
          ),
          7 => 
          array (
            'text' => 'range(0, 10, 2) generates:',
            'options' => 
            array (
              0 => '0, 2, 4, 6, 8',
              1 => '0, 1, 2, ..., 9',
              2 => '2, 4, 6, 8, 10',
              3 => '0, 10',
            ),
            'correct' => 0,
          ),
          8 => 
          array (
            'text' => 'If iteration count is unknown, which loop is better?',
            'options' => 
            array (
              0 => 'while',
              1 => 'for',
              2 => 'foreach',
              3 => 'repeat',
            ),
            'correct' => 0,
          ),
          9 => 
          array (
            'text' => 'How many times does for i in range(3): print(i) run?',
            'options' => 
            array (
              0 => '3',
              1 => '2',
              2 => '4',
              3 => '1',
            ),
            'correct' => 0,
          ),
        ),
      ),
    ),
    4 => 
    array (
      'ru' => 
      array (
        'title' => 'Тест: Функции',
        'questions' => 
        array (
          0 => 
          array (
            'text' => 'Как объявить функцию в Python?',
            'options' => 
            array (
              0 => 'def my_func():',
              1 => 'function myFunc()',
              2 => 'func myFunc()',
              3 => 'fn myFunc()',
            ),
            'correct' => 0,
          ),
          1 => 
          array (
            'text' => 'Что делает return?',
            'options' => 
            array (
              0 => 'Возвращает значение и завершает функцию',
              1 => 'Печатает результат',
              2 => 'Объявляет переменную',
              3 => 'Вызывает другую функцию',
            ),
            'correct' => 0,
          ),
          2 => 
          array (
            'text' => 'Что такое self в методе класса?',
            'options' => 
            array (
              0 => 'Ссылка на текущий объект',
              1 => 'Имя класса',
              2 => 'Глобальная переменная',
              3 => 'Ключевое слово static',
            ),
            'correct' => 0,
          ),
          3 => 
          array (
            'text' => 'Как задать значение параметра по умолчанию?',
            'options' => 
            array (
              0 => 'def f(x=10):',
              1 => 'def f(x := 10):',
              2 => 'def f(default x=10):',
              3 => 'def f(x): default 10',
            ),
            'correct' => 0,
          ),
          4 => 
          array (
            'text' => 'Что такое lambda?',
            'options' => 
            array (
              0 => 'Анонимная функция',
              1 => 'Тип данных',
              2 => 'Модуль',
              3 => 'Декоратор',
            ),
            'correct' => 0,
          ),
          5 => 
          array (
            'text' => 'Что хранит *args внутри функции?',
            'options' => 
            array (
              0 => 'Кортеж позиционных аргументов',
              1 => 'Словарь',
              2 => 'Только список строк',
              3 => 'Количество аргументов',
            ),
            'correct' => 0,
          ),
          6 => 
          array (
            'text' => 'Как вызвать add(a=1, b=2)?',
            'options' => 
            array (
              0 => 'add(a=1, b=2)',
              1 => 'add(1, 2, named=True)',
              2 => 'add{a:1, b:2}',
              3 => 'named.add(1, 2)',
            ),
            'correct' => 0,
          ),
          7 => 
          array (
            'text' => 'Где доступны локальные переменные?',
            'options' => 
            array (
              0 => 'Только внутри функции',
              1 => 'Во всей программе',
              2 => 'Только в main',
              3 => 'В том же файле',
            ),
            'correct' => 0,
          ),
          8 => 
          array (
            'text' => 'Что такое docstring?',
            'options' => 
            array (
              0 => 'Документация функции',
              1 => 'Комментарий #',
              2 => 'Возвращаемый тип',
              3 => 'Имя модуля',
            ),
            'correct' => 0,
          ),
          9 => 
          array (
            'text' => 'Что возвращает рекурсивный factorial(0)?',
            'options' => 
            array (
              0 => '1 (базовый случай)',
              1 => '0',
              2 => 'None',
              3 => 'Ошибка',
            ),
            'correct' => 0,
          ),
        ),
      ),
      'en' => 
      array (
        'title' => 'Test: Functions',
        'questions' => 
        array (
          0 => 
          array (
            'text' => 'How do you declare a function in Python?',
            'options' => 
            array (
              0 => 'def my_func():',
              1 => 'function myFunc()',
              2 => 'func myFunc()',
              3 => 'fn myFunc()',
            ),
            'correct' => 0,
          ),
          1 => 
          array (
            'text' => 'What does return do?',
            'options' => 
            array (
              0 => 'Returns a value and ends the function',
              1 => 'Prints the result',
              2 => 'Declares a variable',
              3 => 'Calls another function',
            ),
            'correct' => 0,
          ),
          2 => 
          array (
            'text' => 'What is self in an instance method?',
            'options' => 
            array (
              0 => 'Reference to the current object',
              1 => 'Class name',
              2 => 'Global variable',
              3 => 'static keyword',
            ),
            'correct' => 0,
          ),
          3 => 
          array (
            'text' => 'How do you set a default parameter value?',
            'options' => 
            array (
              0 => 'def f(x=10):',
              1 => 'def f(x := 10):',
              2 => 'def f(default x=10):',
              3 => 'def f(x): default 10',
            ),
            'correct' => 0,
          ),
          4 => 
          array (
            'text' => 'What is lambda?',
            'options' => 
            array (
              0 => 'Anonymous function',
              1 => 'Data type',
              2 => 'Module',
              3 => 'Decorator',
            ),
            'correct' => 0,
          ),
          5 => 
          array (
            'text' => 'What does *args store inside a function?',
            'options' => 
            array (
              0 => 'Tuple of positional arguments',
              1 => 'Dictionary',
              2 => 'Only a list of strings',
              3 => 'Argument count',
            ),
            'correct' => 0,
          ),
          6 => 
          array (
            'text' => 'How do you call add(a=1, b=2)?',
            'options' => 
            array (
              0 => 'add(a=1, b=2)',
              1 => 'add(1, 2, named=True)',
              2 => 'add{a:1, b:2}',
              3 => 'named.add(1, 2)',
            ),
            'correct' => 0,
          ),
          7 => 
          array (
            'text' => 'Where are local variables accessible?',
            'options' => 
            array (
              0 => 'Only inside the function',
              1 => 'Throughout the program',
              2 => 'Only in main',
              3 => 'In the same file',
            ),
            'correct' => 0,
          ),
          8 => 
          array (
            'text' => 'What is a docstring?',
            'options' => 
            array (
              0 => 'Function documentation',
              1 => '# comment',
              2 => 'Return type',
              3 => 'Module name',
            ),
            'correct' => 0,
          ),
          9 => 
          array (
            'text' => 'What does recursive factorial(0) return?',
            'options' => 
            array (
              0 => '1 (base case)',
              1 => '0',
              2 => 'None',
              3 => 'Error',
            ),
            'correct' => 0,
          ),
        ),
      ),
    ),
    5 => 
    array (
      'ru' => 
      array (
        'title' => 'Тест: Списки и словари',
        'questions' => 
        array (
          0 => 
          array (
            'text' => 'Как создать пустой список?',
            'options' => 
            array (
              0 => '[]',
              1 => '{}',
              2 => '()',
              3 => 'list{}',
            ),
            'correct' => 0,
          ),
          1 => 
          array (
            'text' => 'Индекс первого элемента списка?',
            'options' => 
            array (
              0 => '0',
              1 => '1',
              2 => '-0',
              3 => 'Зависит от длины',
            ),
            'correct' => 0,
          ),
          2 => 
          array (
            'text' => 'Метод добавления в конец списка?',
            'options' => 
            array (
              0 => 'append()',
              1 => 'add()',
              2 => 'push()',
              3 => 'insert_end()',
            ),
            'correct' => 0,
          ),
          3 => 
          array (
            'text' => 'Что такое dict?',
            'options' => 
            array (
              0 => 'Коллекция пар ключ-значение',
              1 => 'Список чисел',
              2 => 'Неизменяемый список',
              3 => 'Множество уникальных чисел',
            ),
            'correct' => 0,
          ),
          4 => 
          array (
            'text' => 'Зачем d.get("k")?',
            'options' => 
            array (
              0 => 'Не вызывает ошибку, если ключа нет',
              1 => 'Всегда без ошибок',
              2 => 'd.find("k")',
              3 => 'd.pull("k")',
            ),
            'correct' => 0,
          ),
          5 => 
          array (
            'text' => 'Чем tuple отличается от list?',
            'options' => 
            array (
              0 => 'Неизменяем',
              1 => 'Только для чисел',
              2 => 'Быстрее только на Windows',
              3 => 'Ничем',
            ),
            'correct' => 0,
          ),
          6 => 
          array (
            'text' => 'Результат [x**2 for x in range(4)]?',
            'options' => 
            array (
              0 => '[0, 1, 4, 9]',
              1 => '[1, 4, 9, 16]',
              2 => '[0, 2, 4, 6]',
              3 => '[4, 3, 2, 1]',
            ),
            'correct' => 0,
          ),
          7 => 
          array (
            'text' => 'Что возвращает d.keys()?',
            'options' => 
            array (
              0 => 'Ключи словаря',
              1 => 'd.keys',
              2 => 'keys(d)',
              3 => 'd.all_keys()',
            ),
            'correct' => 0,
          ),
          8 => 
          array (
            'text' => 'Результат set([1, 2, 2, 3])?',
            'options' => 
            array (
              0 => '{1, 2, 3}',
              1 => '[1, 2, 3]',
              2 => '[1, 2, 2, 3]',
              3 => 'Ошибка',
            ),
            'correct' => 0,
          ),
          9 => 
          array (
            'text' => 'Как объединить два словаря в Python 3.9+?',
            'options' => 
            array (
              0 => 'd1 | d2',
              1 => 'd1 + d2',
              2 => 'merge(d1, d2) only',
              3 => 'd1 & d2',
            ),
            'correct' => 0,
          ),
        ),
      ),
      'en' => 
      array (
        'title' => 'Test: Lists and Dictionaries',
        'questions' => 
        array (
          0 => 
          array (
            'text' => 'How do you create an empty list?',
            'options' => 
            array (
              0 => '[]',
              1 => '{}',
              2 => '()',
              3 => 'list{}',
            ),
            'correct' => 0,
          ),
          1 => 
          array (
            'text' => 'Index of the first list element?',
            'options' => 
            array (
              0 => '0',
              1 => '1',
              2 => '-0',
              3 => 'Depends on length',
            ),
            'correct' => 0,
          ),
          2 => 
          array (
            'text' => 'Method to append to a list?',
            'options' => 
            array (
              0 => 'append()',
              1 => 'add()',
              2 => 'push()',
              3 => 'insert_end()',
            ),
            'correct' => 0,
          ),
          3 => 
          array (
            'text' => 'What is a dict?',
            'options' => 
            array (
              0 => 'Key-value collection',
              1 => 'Number list',
              2 => 'Immutable list',
              3 => 'Unique number set',
            ),
            'correct' => 0,
          ),
          4 => 
          array (
            'text' => 'Why use d.get("k")?',
            'options' => 
            array (
              0 => 'No error if key is missing',
              1 => 'Never errors',
              2 => 'd.find("k")',
              3 => 'd.pull("k")',
            ),
            'correct' => 0,
          ),
          5 => 
          array (
            'text' => 'How is a tuple different from a list?',
            'options' => 
            array (
              0 => 'It is immutable',
              1 => 'Only for numbers',
              2 => 'Faster only on Windows',
              3 => 'No difference',
            ),
            'correct' => 0,
          ),
          6 => 
          array (
            'text' => 'Result of [x**2 for x in range(4)]?',
            'options' => 
            array (
              0 => '[0, 1, 4, 9]',
              1 => '[1, 4, 9, 16]',
              2 => '[0, 2, 4, 6]',
              3 => '[4, 3, 2, 1]',
            ),
            'correct' => 0,
          ),
          7 => 
          array (
            'text' => 'What does d.keys() return?',
            'options' => 
            array (
              0 => 'Dictionary keys',
              1 => 'd.keys',
              2 => 'keys(d)',
              3 => 'd.all_keys()',
            ),
            'correct' => 0,
          ),
          8 => 
          array (
            'text' => 'Result of set([1, 2, 2, 3])?',
            'options' => 
            array (
              0 => '{1, 2, 3}',
              1 => '[1, 2, 3]',
              2 => '[1, 2, 2, 3]',
              3 => 'Error',
            ),
            'correct' => 0,
          ),
          9 => 
          array (
            'text' => 'How to merge two dicts in Python 3.9+?',
            'options' => 
            array (
              0 => 'd1 | d2',
              1 => 'd1 + d2',
              2 => 'merge(d1, d2) only',
              3 => 'd1 & d2',
            ),
            'correct' => 0,
          ),
        ),
      ),
    ),
    6 => 
    array (
      'ru' => 
      array (
        'title' => 'Тест: Работа со строками',
        'questions' => 
        array (
          0 => 
          array (
            'text' => 'Как записать f-строку с переменной name?',
            'options' => 
            array (
              0 => 'f"Привет, {name}"',
              1 => '"Привет, {name}"',
              2 => 'format(name)',
              3 => 'str(name, "Привет")',
            ),
            'correct' => 0,
          ),
          1 => 
          array (
            'text' => 'Результат "Python".upper()?',
            'options' => 
            array (
              0 => 'PYTHON',
              1 => 'python',
              2 => 'Python',
              3 => 'PyThOn',
            ),
            'correct' => 0,
          ),
          2 => 
          array (
            'text' => 'Результат "  hi  ".strip()?',
            'options' => 
            array (
              0 => '"hi"',
              1 => '"  hi  "',
              2 => '"hi  "',
              3 => '"  hi"',
            ),
            'correct' => 0,
          ),
          3 => 
          array (
            'text' => 'Как разбить "a,b,c" по запятой?',
            'options' => 
            array (
              0 => '"a,b,c".split(",")',
              1 => '"a,b,c".split()',
              2 => 'split("a,b,c", ",")',
              3 => '"a,b,c".parts(",")',
            ),
            'correct' => 0,
          ),
          4 => 
          array (
            'text' => 'Результат "Py" in "Python"?',
            'options' => 
            array (
              0 => 'True',
              1 => 'False',
              2 => '1',
              3 => '0',
            ),
            'correct' => 0,
          ),
          5 => 
          array (
            'text' => 'Что делает s.replace("cat", "dog")?',
            'options' => 
            array (
              0 => 'Заменяет "cat" на "dog"',
              1 => 's.sub("cat", "dog")',
              2 => 'replace(s, "cat", "dog")',
              3 => 's.swap("cat", "dog")',
            ),
            'correct' => 0,
          ),
          6 => 
          array (
            'text' => 'Что означает \\n в строке?',
            'options' => 
            array (
              0 => 'Новая строка',
              1 => 'Обратный слэш и n',
              2 => 'Табуляция',
              3 => 'Конец файла',
            ),
            'correct' => 0,
          ),
          7 => 
          array (
            'text' => 'Что даёт s[-1]?',
            'options' => 
            array (
              0 => 'Последний символ',
              1 => 's[last]',
              2 => 's[len(s)]',
              3 => 's(0)',
            ),
            'correct' => 0,
          ),
          8 => 
          array (
            'text' => 'Результат len("Python")?',
            'options' => 
            array (
              0 => '6',
              1 => '5',
              2 => '7',
              3 => '0',
            ),
            'correct' => 0,
          ),
          9 => 
          array (
            'text' => 'Как склеить ["a", "b"] через "-"?',
            'options' => 
            array (
              0 => '"-".join(["a", "b"])',
              1 => '["a", "b"].join("-")',
              2 => 'join("-", ["a", "b"])',
              3 => '"-" + ["a", "b"]',
            ),
            'correct' => 0,
          ),
        ),
      ),
      'en' => 
      array (
        'title' => 'Test: Working with Strings',
        'questions' => 
        array (
          0 => 
          array (
            'text' => 'How do you write an f-string with name?',
            'options' => 
            array (
              0 => 'f"Hello, {name}"',
              1 => '"Hello, {name}"',
              2 => 'format(name)',
              3 => 'str(name, "Hello")',
            ),
            'correct' => 0,
          ),
          1 => 
          array (
            'text' => 'Result of "Python".upper()?',
            'options' => 
            array (
              0 => 'PYTHON',
              1 => 'python',
              2 => 'Python',
              3 => 'PyThOn',
            ),
            'correct' => 0,
          ),
          2 => 
          array (
            'text' => 'Result of "  hi  ".strip()?',
            'options' => 
            array (
              0 => '"hi"',
              1 => '"  hi  "',
              2 => '"hi  "',
              3 => '"  hi"',
            ),
            'correct' => 0,
          ),
          3 => 
          array (
            'text' => 'How to split "a,b,c" by comma?',
            'options' => 
            array (
              0 => '"a,b,c".split(",")',
              1 => '"a,b,c".split()',
              2 => 'split("a,b,c", ",")',
              3 => '"a,b,c".parts(",")',
            ),
            'correct' => 0,
          ),
          4 => 
          array (
            'text' => 'Result of "Py" in "Python"?',
            'options' => 
            array (
              0 => 'True',
              1 => 'False',
              2 => '1',
              3 => '0',
            ),
            'correct' => 0,
          ),
          5 => 
          array (
            'text' => 'What does s.replace("cat", "dog") do?',
            'options' => 
            array (
              0 => 'Replaces "cat" with "dog"',
              1 => 's.sub("cat", "dog")',
              2 => 'replace(s, "cat", "dog")',
              3 => 's.swap("cat", "dog")',
            ),
            'correct' => 0,
          ),
          6 => 
          array (
            'text' => 'What does \\n mean in a string?',
            'options' => 
            array (
              0 => 'New line',
              1 => 'Backslash and n',
              2 => 'Tab',
              3 => 'End of file',
            ),
            'correct' => 0,
          ),
          7 => 
          array (
            'text' => 'What does s[-1] give?',
            'options' => 
            array (
              0 => 'Last character',
              1 => 's[last]',
              2 => 's[len(s)]',
              3 => 's(0)',
            ),
            'correct' => 0,
          ),
          8 => 
          array (
            'text' => 'Result of len("Python")?',
            'options' => 
            array (
              0 => '6',
              1 => '5',
              2 => '7',
              3 => '0',
            ),
            'correct' => 0,
          ),
          9 => 
          array (
            'text' => 'How to join ["a", "b"] with "-"?',
            'options' => 
            array (
              0 => '"-".join(["a", "b"])',
              1 => '["a", "b"].join("-")',
              2 => 'join("-", ["a", "b"])',
              3 => '"-" + ["a", "b"]',
            ),
            'correct' => 0,
          ),
        ),
      ),
    ),
    7 => 
    array (
      'ru' => 
      array (
        'title' => 'Тест: ООП в Python',
        'questions' => 
        array (
          0 => 
          array (
            'text' => 'Какой метод является конструктором класса?',
            'options' => 
            array (
              0 => '__init__',
              1 => '__new__',
              2 => '__create__',
              3 => 'constructor',
            ),
            'correct' => 0,
          ),
          1 => 
          array (
            'text' => 'Что такое self в методе экземпляра?',
            'options' => 
            array (
              0 => 'Текущий объект',
              1 => 'Родительский класс',
              2 => 'Модуль',
              3 => 'Глобальная область',
            ),
            'correct' => 0,
          ),
          2 => 
          array (
            'text' => 'Как создать объект класса Dog?',
            'options' => 
            array (
              0 => 'Dog()',
              1 => 'new Dog',
              2 => 'Dog.create()',
              3 => 'create Dog',
            ),
            'correct' => 0,
          ),
          3 => 
          array (
            'text' => 'Что такое наследование?',
            'options' => 
            array (
              0 => 'Дочерний класс получает свойства родителя',
              1 => 'Копирование файла',
              2 => 'Импорт модуля',
              3 => 'Создание двух объектов',
            ),
            'correct' => 0,
          ),
          4 => 
          array (
            'text' => 'Как вызвать __init__ родителя?',
            'options' => 
            array (
              0 => 'super().__init__()',
              1 => 'parent.init()',
              2 => 'self.parent()',
              3 => 'base()',
            ),
            'correct' => 0,
          ),
          5 => 
          array (
            'text' => 'Где хранятся атрибуты объекта?',
            'options' => 
            array (
              0 => 'В экземпляре (self)',
              1 => 'Только в классе',
              2 => 'В глобальной области',
              3 => 'В модуле os',
            ),
            'correct' => 0,
          ),
          6 => 
          array (
            'text' => 'Что делает декоратор @property?',
            'options' => 
            array (
              0 => 'Превращает метод в геттер атрибута',
              1 => 'Делает метод static',
              2 => 'Удаляет атрибут',
              3 => 'Создаёт класс',
            ),
            'correct' => 0,
          ),
          7 => 
          array (
            'text' => 'Разница между классом и объектом?',
            'options' => 
            array (
              0 => 'Класс — шаблон, объект — экземпляр',
              1 => 'Одинаковы',
              2 => 'Объект — шаблон',
              3 => 'Класс нельзя вызвать',
            ),
            'correct' => 0,
          ),
          8 => 
          array (
            'text' => 'Строковое представление для print()?',
            'options' => 
            array (
              0 => '__str__',
              1 => '__print__',
              2 => '__repr__ only',
              3 => '__text__',
            ),
            'correct' => 0,
          ),
          9 => 
          array (
            'text' => 'Что такое инкапсуляция в ООП?',
            'options' => 
            array (
              0 => 'Скрытие внутренних данных объекта',
              1 => 'Наследование от двух классов',
              2 => 'Создание многих объектов',
              3 => 'Удаление методов',
            ),
            'correct' => 0,
          ),
        ),
      ),
      'en' => 
      array (
        'title' => 'Test: OOP in Python',
        'questions' => 
        array (
          0 => 
          array (
            'text' => 'Which method is the class constructor?',
            'options' => 
            array (
              0 => '__init__',
              1 => '__new__',
              2 => '__create__',
              3 => 'constructor',
            ),
            'correct' => 0,
          ),
          1 => 
          array (
            'text' => 'What is self in an instance method?',
            'options' => 
            array (
              0 => 'The current object',
              1 => 'Parent class',
              2 => 'Module',
              3 => 'Global scope',
            ),
            'correct' => 0,
          ),
          2 => 
          array (
            'text' => 'How do you create a Dog object?',
            'options' => 
            array (
              0 => 'Dog()',
              1 => 'new Dog',
              2 => 'Dog.create()',
              3 => 'create Dog',
            ),
            'correct' => 0,
          ),
          3 => 
          array (
            'text' => 'What is inheritance?',
            'options' => 
            array (
              0 => 'Child class gets parent properties',
              1 => 'File copy',
              2 => 'Module import',
              3 => 'Creating two objects',
            ),
            'correct' => 0,
          ),
          4 => 
          array (
            'text' => 'How do you call the parent __init__?',
            'options' => 
            array (
              0 => 'super().__init__()',
              1 => 'parent.init()',
              2 => 'self.parent()',
              3 => 'base()',
            ),
            'correct' => 0,
          ),
          5 => 
          array (
            'text' => 'Where are object attributes stored?',
            'options' => 
            array (
              0 => 'In the instance (self)',
              1 => 'Only in the class',
              2 => 'In global scope',
              3 => 'In the os module',
            ),
            'correct' => 0,
          ),
          6 => 
          array (
            'text' => 'What does @property do?',
            'options' => 
            array (
              0 => 'Turns a method into an attribute getter',
              1 => 'Makes a method static',
              2 => 'Deletes an attribute',
              3 => 'Creates a class',
            ),
            'correct' => 0,
          ),
          7 => 
          array (
            'text' => 'Difference between class and object?',
            'options' => 
            array (
              0 => 'Class is a blueprint, object is an instance',
              1 => 'They are the same',
              2 => 'Object is a blueprint',
              3 => 'You cannot call a class',
            ),
            'correct' => 0,
          ),
          8 => 
          array (
            'text' => 'String representation for print()?',
            'options' => 
            array (
              0 => '__str__',
              1 => '__print__',
              2 => '__repr__ only',
              3 => '__text__',
            ),
            'correct' => 0,
          ),
          9 => 
          array (
            'text' => 'What is encapsulation in OOP?',
            'options' => 
            array (
              0 => 'Hiding internal object data',
              1 => 'Inheriting from two classes',
              2 => 'Creating many objects',
              3 => 'Removing methods',
            ),
            'correct' => 0,
          ),
        ),
      ),
    ),
  ),
  'assignments' => 
  array (
    0 => 
    array (
      0 => 
      array (
        'ru' => 
        array (
          'title' => 'Установка Python и первая программа',
          'description' => 'Установите Python и создайте файл с print("Hello, World!")',
        ),
        'en' => 
        array (
          'title' => 'Installing Python and first program',
          'description' => 'Install Python and create a file with print("Hello, World!")',
        ),
      ),
    ),
    1 => 
    array (
      0 => 
      array (
        'ru' => 
        array (
          'title' => 'Работа с переменными',
          'description' => 'Напишите программу, демонстрирующую основные типы данных Python',
        ),
        'en' => 
        array (
          'title' => 'Working with variables',
          'description' => 'Write a program demonstrating basic Python data types',
        ),
      ),
      1 => 
      array (
        'ru' => 
        array (
          'title' => 'Преобразование типов',
          'description' => 'Приведите примеры функций int(), str(), float()',
        ),
        'en' => 
        array (
          'title' => 'Type conversion',
          'description' => 'Show examples of int(), str(), and float()',
        ),
      ),
    ),
    2 => 
    array (
      0 => 
      array (
        'ru' => 
        array (
          'title' => 'Условия if-else',
          'description' => 'Напишите программу, проверяющую возраст пользователя',
        ),
        'en' => 
        array (
          'title' => 'If-else conditions',
          'description' => 'Write a program that checks the user age',
        ),
      ),
      1 => 
      array (
        'ru' => 
        array (
          'title' => 'Несколько условий',
          'description' => 'Создайте калькулятор с if/elif',
        ),
        'en' => 
        array (
          'title' => 'Multiple conditions',
          'description' => 'Build a calculator using if/elif',
        ),
      ),
    ),
    3 => 
    array (
      0 => 
      array (
        'ru' => 
        array (
          'title' => 'Таблица умножения',
          'description' => 'Выведите таблицу 9×9 с помощью циклов for',
        ),
        'en' => 
        array (
          'title' => 'Multiplication table',
          'description' => 'Print a 9×9 table using for loops',
        ),
      ),
      1 => 
      array (
        'ru' => 
        array (
          'title' => 'Поиск простых чисел',
          'description' => 'Найдите все простые числа от 1 до 100',
        ),
        'en' => 
        array (
          'title' => 'Find prime numbers',
          'description' => 'Find all prime numbers from 1 to 100',
        ),
      ),
    ),
    4 => 
    array (
      0 => 
      array (
        'ru' => 
        array (
          'title' => 'Создание функций',
          'description' => 'Напишите 5 функций для математических операций',
        ),
        'en' => 
        array (
          'title' => 'Creating functions',
          'description' => 'Write 5 functions for math operations',
        ),
      ),
    ),
    5 => 
    array (
      0 => 
      array (
        'ru' => 
        array (
          'title' => 'Работа со списками',
          'description' => 'Напишите программу обработки списка чисел (сумма, среднее, сортировка)',
        ),
        'en' => 
        array (
          'title' => 'Working with lists',
          'description' => 'Process a number list: sum, average, sort',
        ),
      ),
    ),
    6 => 
    array (
      0 => 
      array (
        'ru' => 
        array (
          'title' => 'Обработка строк',
          'description' => 'Проверьте корректность email с помощью строковых методов',
        ),
        'en' => 
        array (
          'title' => 'String processing',
          'description' => 'Validate an email using string methods',
        ),
      ),
    ),
    7 => 
    array (
      0 => 
      array (
        'ru' => 
        array (
          'title' => 'Классы и объекты',
          'description' => 'Создайте класс Student с методами получения и установки данных',
        ),
        'en' => 
        array (
          'title' => 'Classes and objects',
          'description' => 'Create a Student class with getter/setter methods',
        ),
      ),
    ),
  ),
);
