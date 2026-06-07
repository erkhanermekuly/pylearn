<?php

return [
    [
        ['title' => 'Файл оқу және жазу', 'description' => 'data.txt файлын оқып, нәтижені output.txt-ке жазатын бағдарлама жазыңыз'],
        ['title' => 'try-except қолдану', 'description' => 'Пайдаланушы сан енгізетін бағдарлама — ZeroDivisionError және ValueError ұстаңыз'],
    ],
    [
        ['title' => 'Модуль импорттау', 'description' => 'math, random, datetime модульдерін қолданатын скрипт жазыңыз'],
        ['title' => 'requirements.txt', 'description' => 'venv ортада pip freeze нәтижесін requirements.txt файлына сақтаңыз'],
    ],
    [
        ['title' => 'Django жоба орнату', 'description' => 'django-admin startproject арқылы жоба жасап, runserver іске қосыңыз'],
        ['title' => 'Бірінші view', 'description' => 'HttpResponse қайтаратын home view және URL байлаңыз'],
    ],
    [
        ['title' => 'Article моделі', 'description' => 'title, content, created_at бар Article моделін жасап migrate жасаңыз'],
        ['title' => 'Admin тіркеу', 'description' => 'Article моделін admin panelге қосып, 2 мақала енгізіңіз'],
    ],
    [
        ['title' => 'Article list view', 'description' => 'Барлық мақалаларды көрсететін view және URL жасаңыз'],
        ['title' => 'Detail view', 'description' => 'pk арқылы бір мақаланы көрсететін detail view жасаңыз'],
    ],
    [
        ['title' => 'base.html', 'description' => 'Мұра etумен base.html және list.html шаблондарын жасаңыз'],
        ['title' => 'Static CSS', 'description' => '{% load static %} арқылы CSS файлын шаблонға қосыңыз'],
    ],
    [
        ['title' => 'ContactForm', 'description' => 'name, email, message бар ContactForm және view жасаңыз'],
        ['title' => 'ModelForm', 'description' => 'Article үшін ModelForm жасап, POST арқылы сақтаңыз'],
    ],
    [
        ['title' => 'Login қорғанысы', 'description' => '@login_required декораторы бар dashboard view жасаңыз'],
        ['title' => 'DRF API', 'description' => 'ArticleSerializer және ViewSet арқылы /api/articles/ endpoint жасаңыз'],
    ],
];
