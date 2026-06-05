<?php

return [
    [
        'title' => 'Python таныстыру',
        'content' => <<<'TEXT'
Python — жалпы мақсаттағы жоғары деңгейлі бағдарламалау тілі. Оны Гвидо ван Россум жасаған, алғашқы нұсқасы 1991 жылы шықты. Python веб-дамытуда, деректерді талдауда, машиналық оқытуда, автоматтандыруда және ғылыми есептеулерде қолданылады.

Неге Python танымал:
• Қарапайым және оқуға оңай синтаксис — код кәдімгі мәтінге ұқсайды
• Үлкен стандартты кітапхана — дайын құралдар көп
• Белсенді қауымдастық және көптеген кітапханалар (pip)
• Кроссплатформалық — Windows, macOS, Linux жүйелерінде жұмыс істейді

Орнату:
1. python.org сайтынан Python жүктеп алыңыз (3.10+ нұсқасын ұсынамыз)
2. Орнату кезінде «Add Python to PATH» опциясын қойыңыз
3. Тексеріңіз: python --version

Бірінші бағдарлама:
print("Hello, World!")

print() функциясы мәтінді экранға шығарады. Python-да жолдар " немесе ' кавычкаларына алынады.

Интерактивті режим (REPL):
Терминалда python деп іске қосыңыз — командаларды жолма-жол енгізіп, нәтижені бірден көруге болады.

Код файлы .py кеңейтімімен сақталады. Іске қосу: python main.py

Пікірлер # таңбасымен басталады және интерпретатор елемейді:
# Бұл пікір
print("Сәлем")  # жол соңындағы пікір

Python-да шегіністер маңызды — олар код блоктарын анықтайды (әдетте 4 бос орын).
TEXT,
    ],
    [
        'title' => 'Айнымалылар мен деректер типтері',
        'content' => <<<'TEXT'
Айнымалы — деректерді сақтауға арналған атталған жад аймағы. Python-да типті алдын ала объявление жасау керек емес:

name = "Асхат"
age = 17
height = 1.75
is_student = True

Негізгі деректер типтері:
• int — бүтін сандар: 42, -7, 0
• float — бөлшек сандар: 3.14, -0.5, 2.0
• str — жолдар: "Python", 'hello'
• bool — логикалық: True, False

Типті тексеру: type(x) → <class 'int'>

Типтерді түрлендіру:
int("42")      → 42
float("3.14")  → 3.14
str(100)       → "100"
bool(0)        → False
bool(1)        → True

Айнымалы атаулары: әріптер, сандар, _, саннан басталмайды. Регистр маңызды: age ≠ Age.

Көп мәнмен тағайындау:
a, b, c = 1, 2, 3
x = y = z = 0

Тұрақтытар келісім бойынша БАС ӘРІППЕН: MAX_SIZE = 100

Операторлар:
+ - * / // % ** — арифметика
// — бүтінге бөлу, % — қалдық, ** — дәрежеге көтеру

Жолдарды қосуға болады: "Hello" + " " + "World"
Қайталау: "Ha" * 3 → "HaHaHa"

input() пернеттан жол оқиды:
name = input("Атыңызды енгізіңіз: ")
TEXT,
    ],
    [
        'title' => 'Шарт операторлары',
        'content' => <<<'TEXT'
Шарт операторлары шарт орындалғанда ғана кодты орындауға мүмкіндік береді.

if — егер:
if age >= 18:
    print("Ересек")
else:
    print("Кәмелетке толмаған")

elif — әйтпесе егер (if пен else арасында):
score = 85
if score >= 90:
    grade = "A"
elif score >= 75:
    grade = "B"
elif score >= 60:
    grade = "C"
else:
    grade = "F"

Логикалық операторлар:
• and — екі шарт та True
• or — кем дегенде біреуі True
• not — кері айналдыру

if age >= 16 and has_passport:
    print("Құжат рәсімдеуге болады")

Салыстыру: == != < > <= >=
Маңызды: == теңдікті тексереді, = мән тағайындайды!

Тернарлы оператор (қысқа жазу):
result = "иә" if x > 0 else "жоқ"

Truthy және Falsy мәндер:
False, 0, "", [], {}, None — шартта жалған
Қалғаны — шын

if name:  # name бос жол болmasa орындалады
    print(f"Сәлем, {name}!")
TEXT,
    ],
    [
        'title' => 'Циклдер',
        'content' => <<<'TEXT'
Циклдер код блокын бірнеше рет қайталайды.

for циклі — реттілікті обход:
for i in range(5):
    print(i)  # 0, 1, 2, 3, 4

range(start, stop, step):
range(10)       → 0..9
range(2, 8)     → 2..7
range(0, 10, 2) → 0, 2, 4, 6, 8

for item in ["алма", "алмура", "банан"]:
    print(item)

while циклі — шарт True болғанша:
count = 0
while count < 5:
    print(count)
    count += 1

break — циклден дереу шығу
continue — келесі итерацияға өту

for n in range(10):
    if n == 3:
        continue
    if n == 7:
        break
    print(n)

Кесте көбейткіші (ішki цикл):
for i in range(1, 4):
    for j in range(1, 4):
        print(i * j, end=" ")
    print()

else циклде — break болmasa орындалады:
for x in range(3):
    print(x)
else:
    print("Цикл аяқталды")

enumerate() — индекс пен элемент:
for i, fruit in enumerate(["a", "b", "c"]):
    print(i, fruit)
TEXT,
    ],
    [
        'title' => 'Функциялар',
        'content' => <<<'TEXT'
Функция — бірнеше рет шақыруға болатын атталған код блогы.

Анықтау:
def greet(name):
    return f"Сәлем, {name}!"

result = greet("Асхат")
print(result)

Параметрлер мен аргументтер:
def add(a, b):
    return a + b

add(2, 3)  → 5

Әдепкі мәндер:
def power(base, exp=2):
    return base ** exp

power(3)    → 9
power(3, 3) → 27

Атаулы аргументтер: add(a=1, b=2)

*args — кез келген позициялық аргументтер (корteж)
**kwargs — кез келген атаулы аргументтер (сөздік)

def show(*args, **kwargs):
    print(args, kwargs)

lambda — қысқа анонимді функция:
square = lambda x: x ** 2
square(5) → 25

Колдану аясы:
• Локальді айнымалылар — функция ішінде
• Глобалды — функциялар сыртында
global x — функциядан глобалды айнымалыны өзгерту

docstring — функция документтamasы:
def area(r):
    """Шеңбер ауданын есептейді."""
    return 3.14 * r ** 2

Рекурсия — функция өзін шақырады (базалық жағдай керек):
def factorial(n):
    if n <= 1:
        return 1
    return n * factorial(n - 1)
TEXT,
    ],
    [
        'title' => 'Тізімдер мен сөздіктер',
        'content' => <<<'TEXT'
Тізім (list) — реттелген, өзгертілетін жинақ:
fruits = ["алма", "банан", "апельсин"]
numbers = [1, 2, 3, 4, 5]

Индекстеу 0-ден: fruits[0] → "алма", fruits[-1] → соңғы
Кесінділер: numbers[1:4] → [2, 3, 4]

Тізім әдістері:
append(x)  — соңына қосу
insert(i, x) — позицияға енгізу
remove(x)  — алғашқы элементті жою
pop()      — соңғысын алу және жою
sort()     — сорттау
len(lst)   — ұзындығы

List comprehension:
squares = [x**2 for x in range(10)]
evens = [x for x in range(20) if x % 2 == 0]

Сөздік (dict) — кілт:мән жұптары:
student = {"name": "Асхат", "age": 17, "grade": 10}

student["name"]  → "Асхат"
student.get("phone", "жоқ") — кілт болmasa қате шықпайды

Әдістер: keys(), values(), items(), update(), pop()

Кортеж (tuple) — өзгертілмейтін тізім: point = (10, 20)
Жиын (set) — бірегей элементтер: tags = {"python", "web", "ai"}

Сөздікті обход:
for key, value in student.items():
    print(key, value)
TEXT,
    ],
    [
        'title' => 'Жолдармен жұмыс',
        'content' => <<<'TEXT'
Жол (str) — Python-дағы символдар тізбегі.

Жасау:
s1 = "Сәлем"
s2 = 'Әлем'
s3 = """Көп жолды
мәтін"""

Индекстеу және кесінділер тізімдей:
text = "Python"
text[0] → "P", text[-1] → "n", text[0:3] → "Pyt"

f-jолдар (форматтау, Python 3.6+):
name = "Асхат"
age = 17
msg = f"Менің атым {name}, мен {age} жастамын"

Жол әдістері (бастапқы жолды өзгертпейді):
.upper() / .lower() — регистр
.strip() — шеттердегі бос орындарды алу
.split(",") — тізімге бөлу
.replace("a", "o") — ауыстыру
.startswith("Py") / .endswith("on") — тексеру
.find("th") — позиция (-1 болса жоқ)
.join(["a", "b"]) — тізімді склеить

in — кіруді тексеру:
"Py" in "Python" → True

Экранизация: \n — жаңа жол, \t — табуляция, \" — кавычка

len("Python") → 6 — жол ұзындығы
TEXT,
    ],
    [
        'title' => 'Python-дағы ООП',
        'content' => <<<'TEXT'
ООП (объектіге бағдарланған бағдарламалау) — объектілер мен класстарға негізделген парадigma.

Класс — объектінің үлгісі:
class Dog:
    def __init__(self, name, age):
        self.name = name
        self.age = age

    def bark(self):
        return f"{self.name} айтады: Жау!"

dog = Dog("Рекс", 3)
print(dog.bark())

__init__ — конструктор, объект жасалғанда шақырылады.
self — ағымдағы экземпляр сілтемесі.

Атрибуттар — объект деректері (self.name)
Әдістер — класс функциялары (def bark)

Мұralasу — бала класс ата-ананың қасиеттерін алады:
class Animal:
    def __init__(self, name):
        self.name = name

class Cat(Animal):
    def meow(self):
        return "Мияу!"

cat = Cat("Мурка")
cat.meow()

Әдістерді қайта анықтау — бala класста өз __init__:
class Student(Animal):
    def __init__(self, name, grade):
        super().__init__(name)
        self.grade = grade

Инкапсуляция: _protected, __private (келісім бойынша)

@property — атрибут геттері
@staticmethod — self-сыз әдіс
@classmethod — cls аргументі бар әдіс

__str__ — print() үшін объектінің жолдық көрінісі.
TEXT,
    ],
];
