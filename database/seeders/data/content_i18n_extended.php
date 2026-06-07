<?php

return array (
  'lessons' => 
  array (
    8 => 
    array (
      'ru' => 
      array (
        'title' => 'Файлы и исключения',
        'content' => 'Работа с файлами — сохранение и чтение данных на диске.

Открытие файла (with — автоматическое закрытие):
with open("data.txt", "r", encoding="utf-8") as f:
    content = f.read()
    print(content)

Режимы:
• "r" — чтение (read)
• "w" — запись, перезаписывает файл
• "a" — добавление в конец (append)
• "x" — создание нового файла
• "rb" / "wb" — бинарный режим

Построчное чтение:
with open("log.txt", "r", encoding="utf-8") as f:
    for line in f:
        print(line.strip())

Запись:
with open("output.txt", "w", encoding="utf-8") as f:
    f.write("Привет, Lumina!\n")
    f.writelines(["строка 1\n", "строка 2\n"])

pathlib (современный подход):
from pathlib import Path
p = Path("notes.txt")
text = p.read_text(encoding="utf-8")
p.write_text("Новый текст", encoding="utf-8")

Исключения (exceptions) — ошибки во время выполнения:
try:
    x = int(input("Число: "))
    result = 10 / x
except ValueError:
    print("Это не число!")
except ZeroDivisionError:
    print("Деление на ноль невозможно!")
except Exception as e:
    print(f"Ошибка: {e}")
else:
    print(f"Результат: {result}")
finally:
    print("Блок завершён")

raise — вызвать исключение вручную:
if age < 0:
    raise ValueError("Возраст не может быть отрицательным")

JSON-файлы:
import json
data = {"name": "Асхат", "score": 95}
with open("user.json", "w", encoding="utf-8") as f:
    json.dump(data, f, ensure_ascii=False, indent=2)

with open("user.json", "r", encoding="utf-8") as f:
    loaded = json.load(f)',
      ),
      'en' => 
      array (
        'title' => 'Files and Exceptions',
        'content' => 'Working with files means storing and reading data on disk.

Opening a file (with — auto-close):
with open("data.txt", "r", encoding="utf-8") as f:
    content = f.read()
    print(content)

Modes:
• "r" — read
• "w" — write, overwrites the file
• "a" — append to the end
• "x" — create a new file
• "rb" / "wb" — binary mode

Line-by-line reading:
with open("log.txt", "r", encoding="utf-8") as f:
    for line in f:
        print(line.strip())

Writing:
with open("output.txt", "w", encoding="utf-8") as f:
    f.write("Hello, Lumina!\n")
    f.writelines(["line 1\n", "line 2\n"])

pathlib (modern approach):
from pathlib import Path
p = Path("notes.txt")
text = p.read_text(encoding="utf-8")
p.write_text("New text", encoding="utf-8")

Exceptions — runtime errors:
try:
    x = int(input("Number: "))
    result = 10 / x
except ValueError:
    print("Not a number!")
except ZeroDivisionError:
    print("Cannot divide by zero!")
except Exception as e:
    print(f"Error: {e}")
else:
    print(f"Result: {result}")
finally:
    print("Block finished")

raise — raise an exception manually:
if age < 0:
    raise ValueError("Age cannot be negative")

JSON files:
import json
data = {"name": "Askar", "score": 95}
with open("user.json", "w", encoding="utf-8") as f:
    json.dump(data, f, ensure_ascii=False, indent=2)

with open("user.json", "r", encoding="utf-8") as f:
    loaded = json.load(f)',
      ),
    ),
    9 => 
    array (
      'ru' => 
      array (
        'title' => 'Модули и пакеты',
        'content' => 'Модуль — .py файл, набор функций и классов.

Импорт:
import math
print(math.sqrt(16))  # 4.0

from datetime import datetime
now = datetime.now()

from collections import Counter as C
C(["a", "b", "a"])

if __name__ == "__main__":
    # Выполняется только при прямом запуске файла
    main()

Пакет — каталог с модулями (__init__.py):
mypackage/
    __init__.py
    utils.py
    models.py

from mypackage.utils import helper

pip — менеджер внешних пакетов:
pip install requests
pip install django
pip list
pip freeze > requirements.txt
pip install -r requirements.txt

Виртуальное окружение (venv):
python -m venv venv
# Windows: venv\\Scripts\\activate
# Linux/macOS: source venv/bin/activate
deactivate

Стандартные модули:
• os, sys — работа с системой
• random — случайные числа
• re — регулярные выражения
• json — JSON
• pathlib — пути к файлам

Структура проекта (best practice):
project/
    src/
        app/
    tests/
    requirements.txt
    README.md

__all__ — список экспортируемых имён (для from module import *).',
      ),
      'en' => 
      array (
        'title' => 'Modules and Packages',
        'content' => 'A module is a .py file — a collection of functions and classes.

Import:
import math
print(math.sqrt(16))  # 4.0

from datetime import datetime
now = datetime.now()

from collections import Counter as C
C(["a", "b", "a"])

if __name__ == "__main__":
    # Runs only when the file is executed directly
    main()

Package — a directory of modules (__init__.py):
mypackage/
    __init__.py
    utils.py
    models.py

from mypackage.utils import helper

pip — external package manager:
pip install requests
pip install django
pip list
pip freeze > requirements.txt
pip install -r requirements.txt

Virtual environment (venv):
python -m venv venv
# Windows: venv\\Scripts\\activate
# Linux/macOS: source venv/bin/activate
deactivate

Standard modules:
• os, sys — system interaction
• random — random numbers
• re — regular expressions
• json — JSON
• pathlib — file paths

Project structure (best practice):
project/
    src/
        app/
    tests/
    requirements.txt
    README.md

__all__ — list of exported names (for from module import *).',
      ),
    ),
    10 => 
    array (
      'ru' => 
      array (
        'title' => 'Введение в Django и установка',
        'content' => 'Django — полнофункциональный веб-фреймворк на Python. Instagram, Pinterest и другие проекты используют Django.

Почему Django:
• «Batteries included» — ORM, admin, auth, forms из коробки
• Безопасность (защита от CSRF, XSS, SQL injection)
• Масштабируемость и быстрая разработка
• Обширная документация

Архитектура MVT:
• Model — данные и бизнес-логика (ORM)
• View — обработка запроса и ответ
• Template — HTML-представление

Установка:
python -m venv venv
venv\\Scripts\\activate
pip install django
django-admin --version

Создание проекта:
django-admin startproject lumina_site
cd lumina_site
python manage.py runserver

Структура:
lumina_site/
    manage.py
    lumina_site/
        settings.py
        urls.py
        wsgi.py
    (apps/)

Создание приложения (app):
python manage.py startapp blog

settings.py — добавить \'blog\' в INSTALLED_APPS.

Первый view (blog/views.py):
from django.http import HttpResponse

def home(request):
    return HttpResponse("<h1>Lumina Django</h1>")

URL (lumina_site/urls.py):
from django.contrib import admin
from django.urls import path
from blog import views

urlpatterns = [
    path(\'admin/\', admin.site.urls),
    path(\'\', views.home),
]

python manage.py migrate — подготовка базы данных.
python manage.py createsuperuser — пользователь admin.',
      ),
      'en' => 
      array (
        'title' => 'Django Introduction and Installation',
        'content' => 'Django is a full-stack web framework written in Python. Projects like Instagram and Pinterest use Django.

Why Django:
• Batteries included — ORM, admin, auth, forms out of the box
• Security (CSRF, XSS, SQL injection protection)
• Scalable and fast to develop with
• Extensive documentation

MVT architecture:
• Model — data and business logic (ORM)
• View — request handling and response
• Template — HTML presentation

Installation:
python -m venv venv
venv\\Scripts\\activate
pip install django
django-admin --version

Create a project:
django-admin startproject lumina_site
cd lumina_site
python manage.py runserver

Structure:
lumina_site/
    manage.py
    lumina_site/
        settings.py
        urls.py
        wsgi.py
    (apps/)

Create an app:
python manage.py startapp blog

settings.py — add \'blog\' to INSTALLED_APPS.

First view (blog/views.py):
from django.http import HttpResponse

def home(request):
    return HttpResponse("<h1>Lumina Django</h1>")

URL (lumina_site/urls.py):
from django.contrib import admin
from django.urls import path
from blog import views

urlpatterns = [
    path(\'admin/\', admin.site.urls),
    path(\'\', views.home),
]

python manage.py migrate — prepare the database.
python manage.py createsuperuser — admin user.',
      ),
    ),
    11 => 
    array (
      'ru' => 
      array (
        'title' => 'Модели Django и ORM',
        'content' => 'Django ORM — работа с данными через Python без написания SQL.

Модель (blog/models.py):
from django.db import models

class Article(models.Model):
    title = models.CharField(max_length=200)
    content = models.TextField()
    created_at = models.DateTimeField(auto_now_add=True)
    is_published = models.BooleanField(default=False)

    class Meta:
        ordering = [\'-created_at\']

    def __str__(self):
        return self.title

Миграции:
python manage.py makemigrations
python manage.py migrate

Admin (blog/admin.py):
from django.contrib import admin
from .models import Article

@admin.register(Article)
class ArticleAdmin(admin.ModelAdmin):
    list_display = [\'title\', \'is_published\', \'created_at\']
    list_filter = [\'is_published\']

Shell:
python manage.py shell
>>> from blog.models import Article
>>> Article.objects.create(title="Python", content="...")
>>> Article.objects.filter(is_published=True)
>>> Article.objects.get(pk=1)

Методы запросов:
• all(), filter(field=value), exclude()
• get(pk=1) — один объект
• order_by(\'-created_at\')
• count(), first(), last()

Связи:
class Author(models.Model):
    name = models.CharField(max_length=100)

class Book(models.Model):
    author = models.ForeignKey(Author, on_delete=models.CASCADE)
    title = models.CharField(max_length=200)

# book.author, author.book_set.all()

on_delete: CASCADE, SET_NULL, PROTECT

QuerySet lazy — SQL не выполняется, пока не обратитесь к данным.',
      ),
      'en' => 
      array (
        'title' => 'Django Models and ORM',
        'content' => 'Django ORM lets you work with data in Python without writing SQL.

Model (blog/models.py):
from django.db import models

class Article(models.Model):
    title = models.CharField(max_length=200)
    content = models.TextField()
    created_at = models.DateTimeField(auto_now_add=True)
    is_published = models.BooleanField(default=False)

    class Meta:
        ordering = [\'-created_at\']

    def __str__(self):
        return self.title

Migrations:
python manage.py makemigrations
python manage.py migrate

Admin (blog/admin.py):
from django.contrib import admin
from .models import Article

@admin.register(Article)
class ArticleAdmin(admin.ModelAdmin):
    list_display = [\'title\', \'is_published\', \'created_at\']
    list_filter = [\'is_published\']

Shell:
python manage.py shell
>>> from blog.models import Article
>>> Article.objects.create(title="Python", content="...")
>>> Article.objects.filter(is_published=True)
>>> Article.objects.get(pk=1)

Query methods:
• all(), filter(field=value), exclude()
• get(pk=1) — single object
• order_by(\'-created_at\')
• count(), first(), last()

Relations:
class Author(models.Model):
    name = models.CharField(max_length=100)

class Book(models.Model):
    author = models.ForeignKey(Author, on_delete=models.CASCADE)
    title = models.CharField(max_length=200)

# book.author, author.book_set.all()

on_delete: CASCADE, SET_NULL, PROTECT

QuerySet is lazy — SQL runs only when you access the data.',
      ),
    ),
    12 => 
    array (
      'ru' => 
      array (
        'title' => 'Представления Django и URL',
        'content' => 'View — принимает HTTP-запрос и возвращает HttpResponse.

Функциональное представление:
from django.http import HttpResponse, JsonResponse
from django.shortcuts import render, get_object_or_404
from .models import Article

def article_list(request):
    articles = Article.objects.filter(is_published=True)
    return render(request, \'blog/list.html\', {\'articles\': articles})

def article_detail(request, pk):
    article = get_object_or_404(Article, pk=pk)
    return render(request, \'blog/detail.html\', {\'article\': article})

Class-Based View (CBV):
from django.views.generic import ListView, DetailView

class ArticleListView(ListView):
    model = Article
    template_name = \'blog/list.html\'
    context_object_name = \'articles\'
    queryset = Article.objects.filter(is_published=True)

Маршрутизация URL (blog/urls.py):
from django.urls import path
from . import views

urlpatterns = [
    path(\'\', views.article_list, name=\'article_list\'),
    path(\'<int:pk>/\', views.article_detail, name=\'article_detail\'),
]

Главный urls.py:
path(\'blog/\', include(\'blog.urls\')),

Конвертеры path: int, str, slug, uuid, path

Объект request:
• request.method — GET, POST
• request.GET, request.POST
• request.user — аутентифицированный пользователь

JsonResponse для API:
return JsonResponse({\'status\': \'ok\', \'count\': 10})

redirect и reverse:
from django.shortcuts import redirect
from django.urls import reverse
return redirect(\'article_list\')',
      ),
      'en' => 
      array (
        'title' => 'Django Views and URL',
        'content' => 'A view accepts an HTTP request and returns HttpResponse.

Function-based view:
from django.http import HttpResponse, JsonResponse
from django.shortcuts import render, get_object_or_404
from .models import Article

def article_list(request):
    articles = Article.objects.filter(is_published=True)
    return render(request, \'blog/list.html\', {\'articles\': articles})

def article_detail(request, pk):
    article = get_object_or_404(Article, pk=pk)
    return render(request, \'blog/detail.html\', {\'article\': article})

Class-Based View (CBV):
from django.views.generic import ListView, DetailView

class ArticleListView(ListView):
    model = Article
    template_name = \'blog/list.html\'
    context_object_name = \'articles\'
    queryset = Article.objects.filter(is_published=True)

URL routing (blog/urls.py):
from django.urls import path
from . import views

urlpatterns = [
    path(\'\', views.article_list, name=\'article_list\'),
    path(\'<int:pk>/\', views.article_detail, name=\'article_detail\'),
]

Main urls.py:
path(\'blog/\', include(\'blog.urls\')),

path converters: int, str, slug, uuid, path

request object:
• request.method — GET, POST
• request.GET, request.POST
• request.user — authenticated user

JsonResponse for API:
return JsonResponse({\'status\': \'ok\', \'count\': 10})

redirect and reverse:
from django.shortcuts import redirect
from django.urls import reverse
return redirect(\'article_list\')',
      ),
    ),
    13 => 
    array (
      'ru' => 
      array (
        'title' => 'Шаблоны Django (Templates)',
        'content' => 'Django Template Language (DTL) — динамическое содержимое в HTML.

settings.py:
TEMPLATES = [{
    \'DIRS\': [BASE_DIR / \'templates\'],
    \'APP_DIRS\': True,
    ...
}]

templates/blog/list.html:
<!DOCTYPE html>
<html>
<body>
  <h1>Статьи</h1>
  {% for article in articles %}
    <article>
      <h2>{{ article.title }}</h2>
      <p>{{ article.content|truncatewords:30 }}</p>
    </article>
  {% empty %}
    <p>Статей нет.</p>
  {% endfor %}
</body>
</html>

Теги:
{% if user.is_authenticated %}Привет, {{ user.username }}{% endif %}
{% for item in list %}...{% endfor %}
{% extends "base.html" %}
{% block content %}...{% endblock %}
{% include "partials/nav.html" %}

Фильтры:
{{ name|upper }}
{{ text|truncatewords:20 }}
{{ value|date:"d.m.Y" }}
{{ html|safe }}  # осторожно!

Наследование (base.html):
<!DOCTYPE html>
<html>
<head><title>{% block title %}Lumina{% endblock %}</title></head>
<body>
  {% block content %}{% endblock %}
</body>
</html>

Context processors — глобальные переменные для всех шаблонов (settings.py TEMPLATES OPTIONS).

Статические файлы:
{% load static %}
<link rel="stylesheet" href="{% static \'css/style.css\' %}">

STATIC_URL = \'static/\'
STATICFILES_DIRS = [BASE_DIR / \'static\']

Пользовательские теги шаблонов — расширяются через {% load blog_tags %}.',
      ),
      'en' => 
      array (
        'title' => 'Django Templates',
        'content' => 'Django Template Language (DTL) — dynamic content inside HTML.

settings.py:
TEMPLATES = [{
    \'DIRS\': [BASE_DIR / \'templates\'],
    \'APP_DIRS\': True,
    ...
}]

templates/blog/list.html:
<!DOCTYPE html>
<html>
<body>
  <h1>Articles</h1>
  {% for article in articles %}
    <article>
      <h2>{{ article.title }}</h2>
      <p>{{ article.content|truncatewords:30 }}</p>
    </article>
  {% empty %}
    <p>No articles.</p>
  {% endfor %}
</body>
</html>

Tags:
{% if user.is_authenticated %}Hello, {{ user.username }}{% endif %}
{% for item in list %}...{% endfor %}
{% extends "base.html" %}
{% block content %}...{% endblock %}
{% include "partials/nav.html" %}

Filters:
{{ name|upper }}
{{ text|truncatewords:20 }}
{{ value|date:"d.m.Y" }}
{{ html|safe }}  # be careful!

Inheritance (base.html):
<!DOCTYPE html>
<html>
<head><title>{% block title %}Lumina{% endblock %}</title></head>
<body>
  {% block content %}{% endblock %}
</body>
</html>

Context processors — global variables for all templates (settings.py TEMPLATES OPTIONS).

Static files:
{% load static %}
<link rel="stylesheet" href="{% static \'css/style.css\' %}">

STATIC_URL = \'static/\'
STATICFILES_DIRS = [BASE_DIR / \'static\']

Custom template tags — extended via {% load blog_tags %}.',
      ),
    ),
    14 => 
    array (
      'ru' => 
      array (
        'title' => 'Формы Django и Admin',
        'content' => 'Формы — валидация пользовательского ввода.

Простая Form (forms.py):
from django import forms

class ContactForm(forms.Form):
    name = forms.CharField(max_length=100, label="Имя")
    email = forms.EmailField()
    message = forms.CharField(widget=forms.Textarea)

View:
def contact(request):
    if request.method == \'POST\':
        form = ContactForm(request.POST)
        if form.is_valid():
            # form.cleaned_data[\'name\']
            return redirect(\'success\')
    else:
        form = ContactForm()
    return render(request, \'contact.html\', {\'form\': form})

Шаблон:
<form method="post">
  {% csrf_token %}
  {{ form.as_p }}
  <button type="submit">Отправить</button>
</form>

ModelForm — автоматическая форма из модели:
class ArticleForm(forms.ModelForm):
    class Meta:
        model = Article
        fields = [\'title\', \'content\', \'is_published\']

Расширение Admin:
class ArticleAdmin(admin.ModelAdmin):
    search_fields = [\'title\', \'content\']
    prepopulated_fields = {\'slug\': (\'title\',)}
    readonly_fields = [\'created_at\']
    fieldsets = (
        (\'Основное\', {\'fields\': (\'title\', \'content\')}),
        (\'Прочее\', {\'fields\': (\'is_published\',)}),
    )

Inline admin (ForeignKey):
class CommentInline(admin.TabularInline):
    model = Comment
    extra = 1

Валидация:
def clean_email(self):
    email = self.cleaned_data[\'email\']
    if not email.endswith(\'.kz\'):
        raise forms.ValidationError(\'Email должен быть в домене .kz\')
    return email

messages framework — уведомления:
from django.contrib import messages
messages.success(request, \'Сохранено!\')',
      ),
      'en' => 
      array (
        'title' => 'Django Forms and Admin',
        'content' => 'Forms validate user input.

Simple Form (forms.py):
from django import forms

class ContactForm(forms.Form):
    name = forms.CharField(max_length=100, label="Name")
    email = forms.EmailField()
    message = forms.CharField(widget=forms.Textarea)

View:
def contact(request):
    if request.method == \'POST\':
        form = ContactForm(request.POST)
        if form.is_valid():
            # form.cleaned_data[\'name\']
            return redirect(\'success\')
    else:
        form = ContactForm()
    return render(request, \'contact.html\', {\'form\': form})

Template:
<form method="post">
  {% csrf_token %}
  {{ form.as_p }}
  <button type="submit">Submit</button>
</form>

ModelForm — auto-generated form from a model:
class ArticleForm(forms.ModelForm):
    class Meta:
        model = Article
        fields = [\'title\', \'content\', \'is_published\']

Admin customization:
class ArticleAdmin(admin.ModelAdmin):
    search_fields = [\'title\', \'content\']
    prepopulated_fields = {\'slug\': (\'title\',)}
    readonly_fields = [\'created_at\']
    fieldsets = (
        (\'Main\', {\'fields\': (\'title\', \'content\')}),
        (\'Other\', {\'fields\': (\'is_published\',)}),
    )

Inline admin (ForeignKey):
class CommentInline(admin.TabularInline):
    model = Comment
    extra = 1

Validation:
def clean_email(self):
    email = self.cleaned_data[\'email\']
    if not email.endswith(\'.kz\'):
        raise forms.ValidationError(\'Email must use a .kz domain\')
    return email

messages framework — user notifications:
from django.contrib import messages
messages.success(request, \'Saved!\')',
      ),
    ),
    15 => 
    array (
      'ru' => 
      array (
        'title' => 'Аутентификация Django и REST API',
        'content' => 'Аутентификация — система auth Django.

createsuperuser, LoginView, LogoutView:
from django.contrib.auth import login, logout, authenticate
from django.contrib.auth.decorators import login_required

@login_required
def dashboard(request):
    return render(request, \'dashboard.html\')

settings.py:
LOGIN_URL = \'/accounts/login/\'
LOGIN_REDIRECT_URL = \'/\'

Модель User: django.contrib.auth.models.User
Кастомный user: AUTH_USER_MODEL = \'accounts.CustomUser\'

Пароль: user.set_password(\'secret\'); user.save()
authenticate(username=\'x\', password=\'y\')

Permissions:
@permission_required(\'blog.change_article\')
user.has_perm(\'blog.add_article\')

Django REST Framework (DRF):
pip install djangorestframework
INSTALLED_APPS += [\'rest_framework\']

Serializer:
from rest_framework import serializers

class ArticleSerializer(serializers.ModelSerializer):
    class Meta:
        model = Article
        fields = [\'id\', \'title\', \'content\', \'created_at\']

ViewSet:
from rest_framework import viewsets

class ArticleViewSet(viewsets.ModelViewSet):
    queryset = Article.objects.all()
    serializer_class = ArticleSerializer

Router (urls.py):
from rest_framework.routers import DefaultRouter
router = DefaultRouter()
router.register(\'articles\', ArticleViewSet)
urlpatterns += router.urls

API: GET /api/articles/, POST /api/articles/

Основы деплоя:
• DEBUG = False в production
• ALLOWED_HOSTS = [\'yourdomain.com\']
• SECRET_KEY хранить безопасно
• collectstatic, gunicorn + nginx
• PostgreSQL как production DB

python manage.py check — проверка конфигурации.',
      ),
      'en' => 
      array (
        'title' => 'Django Authentication and REST API',
        'content' => 'Authentication — Django auth system.

createsuperuser, LoginView, LogoutView:
from django.contrib.auth import login, logout, authenticate
from django.contrib.auth.decorators import login_required

@login_required
def dashboard(request):
    return render(request, \'dashboard.html\')

settings.py:
LOGIN_URL = \'/accounts/login/\'
LOGIN_REDIRECT_URL = \'/\'

User model: django.contrib.auth.models.User
Custom user: AUTH_USER_MODEL = \'accounts.CustomUser\'

Password: user.set_password(\'secret\'); user.save()
authenticate(username=\'x\', password=\'y\')

Permissions:
@permission_required(\'blog.change_article\')
user.has_perm(\'blog.add_article\')

Django REST Framework (DRF):
pip install djangorestframework
INSTALLED_APPS += [\'rest_framework\']

Serializer:
from rest_framework import serializers

class ArticleSerializer(serializers.ModelSerializer):
    class Meta:
        model = Article
        fields = [\'id\', \'title\', \'content\', \'created_at\']

ViewSet:
from rest_framework import viewsets

class ArticleViewSet(viewsets.ModelViewSet):
    queryset = Article.objects.all()
    serializer_class = ArticleSerializer

Router (urls.py):
from rest_framework.routers import DefaultRouter
router = DefaultRouter()
router.register(\'articles\', ArticleViewSet)
urlpatterns += router.urls

API: GET /api/articles/, POST /api/articles/

Deployment basics:
• DEBUG = False in production
• ALLOWED_HOSTS = [\'yourdomain.com\']
• Keep SECRET_KEY secure
• collectstatic, gunicorn + nginx
• PostgreSQL as production DB

python manage.py check — verify configuration.',
      ),
    ),
  ),
  'tests' => 
  array (
    8 => 
    array (
      'ru' => 
      array (
        'title' => 'Тест: Файлы и исключения',
        'questions' => 
        array (
          0 => 
          array (
            'text' => 'Какой режим используется для чтения файла?',
            'options' => 
            array (
              0 => '"r"',
              1 => '"w"',
              2 => '"x"',
              3 => '"a" only write',
            ),
            'correct' => 0,
          ),
          1 => 
          array (
            'text' => 'Зачем используется with open(...)?',
            'options' => 
            array (
              0 => 'Автоматическое закрытие файла',
              1 => 'Открытие двух файлов',
              2 => 'Только JSON',
              3 => 'Только бинарный режим',
            ),
            'correct' => 0,
          ),
          2 => 
          array (
            'text' => 'Когда возникает ZeroDivisionError?',
            'options' => 
            array (
              0 => 'При делении на ноль',
              1 => 'Когда файл не найден',
              2 => 'Ошибка int()',
              3 => 'Ошибка import',
            ),
            'correct' => 0,
          ),
          3 => 
          array (
            'text' => 'Когда выполняется блок finally?',
            'options' => 
            array (
              0 => 'Всегда',
              1 => 'Только при успешном try',
              2 => 'Только при except',
              3 => 'Никогда',
            ),
            'correct' => 0,
          ),
          4 => 
          array (
            'text' => 'Что делает json.dump()?',
            'options' => 
            array (
              0 => 'Записывает Python-объект в JSON-файл',
              1 => 'Читает JSON',
              2 => 'Создаёт SQL',
              3 => 'Выводит HTML',
            ),
            'correct' => 0,
          ),
          5 => 
          array (
            'text' => 'В каком модуле находится Path.read_text()?',
            'options' => 
            array (
              0 => 'pathlib',
              1 => 'os',
              2 => 'sys',
              3 => 'json',
            ),
            'correct' => 0,
          ),
          6 => 
          array (
            'text' => 'Что делает режим "a"?',
            'options' => 
            array (
              0 => 'Добавляет в конец файла',
              1 => 'Удаляет файл',
              2 => 'Только читает',
              3 => 'Только JSON',
            ),
            'correct' => 0,
          ),
          7 => 
          array (
            'text' => 'Зачем нужен raise?',
            'options' => 
            array (
              0 => 'Вызвать исключение вручную',
              1 => 'Открыть файл',
              2 => 'Остановить цикл',
              3 => 'Импорт',
            ),
            'correct' => 0,
          ),
          8 => 
          array (
            'text' => 'Зачем нужен encoding="utf-8"?',
            'options' => 
            array (
              0 => 'Корректное чтение кириллицы',
              1 => 'Скорость',
              2 => 'Бинарный режим',
              3 => 'SQL',
            ),
            'correct' => 0,
          ),
          9 => 
          array (
            'text' => 'Что перехватывает except ValueError?',
            'options' => 
            array (
              0 => 'Ошибки преобразования типов',
              1 => 'Деление на ноль',
              2 => 'Файл не найден',
              3 => 'Syntax',
            ),
            'correct' => 0,
          ),
        ),
      ),
      'en' => 
      array (
        'title' => 'Test: Files and Exceptions',
        'questions' => 
        array (
          0 => 
          array (
            'text' => 'Which mode is used to read a file?',
            'options' => 
            array (
              0 => '"r"',
              1 => '"w"',
              2 => '"x"',
              3 => '"a" only write',
            ),
            'correct' => 0,
          ),
          1 => 
          array (
            'text' => 'Why is with open(...) used?',
            'options' => 
            array (
              0 => 'Automatic file closing',
              1 => 'Open two files',
              2 => 'JSON only',
              3 => 'Binary only',
            ),
            'correct' => 0,
          ),
          2 => 
          array (
            'text' => 'When does ZeroDivisionError occur?',
            'options' => 
            array (
              0 => 'When dividing by zero',
              1 => 'File not found',
              2 => 'int() error',
              3 => 'import error',
            ),
            'correct' => 0,
          ),
          3 => 
          array (
            'text' => 'When does the finally block run?',
            'options' => 
            array (
              0 => 'Always',
              1 => 'Only on successful try',
              2 => 'Only on except',
              3 => 'Never',
            ),
            'correct' => 0,
          ),
          4 => 
          array (
            'text' => 'What does json.dump() do?',
            'options' => 
            array (
              0 => 'Writes a Python object to a JSON file',
              1 => 'Reads JSON',
              2 => 'Creates SQL',
              3 => 'Outputs HTML',
            ),
            'correct' => 0,
          ),
          5 => 
          array (
            'text' => 'Which module contains Path.read_text()?',
            'options' => 
            array (
              0 => 'pathlib',
              1 => 'os',
              2 => 'sys',
              3 => 'json',
            ),
            'correct' => 0,
          ),
          6 => 
          array (
            'text' => 'What does mode "a" do?',
            'options' => 
            array (
              0 => 'Appends to the end of the file',
              1 => 'Deletes the file',
              2 => 'Read only',
              3 => 'JSON only',
            ),
            'correct' => 0,
          ),
          7 => 
          array (
            'text' => 'What is raise used for?',
            'options' => 
            array (
              0 => 'Raise an exception manually',
              1 => 'Open a file',
              2 => 'Stop a loop',
              3 => 'import',
            ),
            'correct' => 0,
          ),
          8 => 
          array (
            'text' => 'Why use encoding="utf-8"?',
            'options' => 
            array (
              0 => 'Correct reading of Cyrillic text',
              1 => 'Speed',
              2 => 'Binary mode',
              3 => 'SQL',
            ),
            'correct' => 0,
          ),
          9 => 
          array (
            'text' => 'What does except ValueError catch?',
            'options' => 
            array (
              0 => 'Type conversion errors',
              1 => 'Division by zero',
              2 => 'File not found',
              3 => 'Syntax',
            ),
            'correct' => 0,
          ),
        ),
      ),
    ),
    9 => 
    array (
      'ru' => 
      array (
        'title' => 'Тест: Модули и пакеты',
        'questions' => 
        array (
          0 => 
          array (
            'text' => 'Что делает import math?',
            'options' => 
            array (
              0 => 'Импортирует модуль math',
              1 => 'Математическая константа',
              2 => 'pip install',
              3 => 'venv',
            ),
            'correct' => 0,
          ),
          1 => 
          array (
            'text' => 'Зачем нужен pip freeze?',
            'options' => 
            array (
              0 => 'Список установленных пакетов',
              1 => 'Удаление пакета',
              2 => 'Обновление Python',
              3 => 'migrate',
            ),
            'correct' => 0,
          ),
          2 => 
          array (
            'text' => 'Что означает __name__ == "__main__"?',
            'options' => 
            array (
              0 => 'Файл запущен напрямую',
              1 => 'Импорт пакета',
              2 => 'Ошибка',
              3 => 'Тест',
            ),
            'correct' => 0,
          ),
          3 => 
          array (
            'text' => 'Зачем нужен venv?',
            'options' => 
            array (
              0 => 'Изолированные зависимости проекта',
              1 => 'Git',
              2 => 'Docker',
              3 => 'Admin',
            ),
            'correct' => 0,
          ),
          4 => 
          array (
            'text' => 'Что должно быть в каталоге пакета?',
            'options' => 
            array (
              0 => '__init__.py',
              1 => 'setup.exe',
              2 => 'manage.py',
              3 => 'urls.py',
            ),
            'correct' => 0,
          ),
          5 => 
          array (
            'text' => 'Зачем нужен requirements.txt?',
            'options' => 
            array (
              0 => 'Переустановка пакетов',
              1 => 'HTML',
              2 => 'SQL',
              3 => 'Лог',
            ),
            'correct' => 0,
          ),
          6 => 
          array (
            'text' => 'Что даёт from datetime import datetime?',
            'options' => 
            array (
              0 => 'Класс datetime',
              1 => 'Сегодняшнюю дату',
              2 => 'UTC only',
              3 => 'JSON',
            ),
            'correct' => 0,
          ),
          7 => 
          array (
            'text' => 'Для чего модуль re?',
            'options' => 
            array (
              0 => 'Regex',
              1 => 'Random',
              2 => 'Request',
              3 => 'Redis',
            ),
            'correct' => 0,
          ),
          8 => 
          array (
            'text' => 'Что делает pip install django?',
            'options' => 
            array (
              0 => 'Устанавливает Django',
              1 => 'Создаёт проект',
              2 => 'migrate',
              3 => 'runserver',
            ),
            'correct' => 0,
          ),
          9 => 
          array (
            'text' => 'Что такое __all__ для from module import *?',
            'options' => 
            array (
              0 => 'Экспортируемые имена',
              1 => 'Все файлы',
              2 => 'Только класс',
              3 => 'Только функция',
            ),
            'correct' => 0,
          ),
        ),
      ),
      'en' => 
      array (
        'title' => 'Test: Modules and Packages',
        'questions' => 
        array (
          0 => 
          array (
            'text' => 'What does import math do?',
            'options' => 
            array (
              0 => 'Imports the math module',
              1 => 'A math constant',
              2 => 'pip install',
              3 => 'venv',
            ),
            'correct' => 0,
          ),
          1 => 
          array (
            'text' => 'What is pip freeze for?',
            'options' => 
            array (
              0 => 'List of installed packages',
              1 => 'Remove a package',
              2 => 'Update Python',
              3 => 'migrate',
            ),
            'correct' => 0,
          ),
          2 => 
          array (
            'text' => 'What does __name__ == "__main__" mean?',
            'options' => 
            array (
              0 => 'File run directly',
              1 => 'Package import',
              2 => 'Error',
              3 => 'Test',
            ),
            'correct' => 0,
          ),
          3 => 
          array (
            'text' => 'What is venv for?',
            'options' => 
            array (
              0 => 'Isolated project dependencies',
              1 => 'Git',
              2 => 'Docker',
              3 => 'Admin',
            ),
            'correct' => 0,
          ),
          4 => 
          array (
            'text' => 'What should be in a package directory?',
            'options' => 
            array (
              0 => '__init__.py',
              1 => 'setup.exe',
              2 => 'manage.py',
              3 => 'urls.py',
            ),
            'correct' => 0,
          ),
          5 => 
          array (
            'text' => 'What is requirements.txt for?',
            'options' => 
            array (
              0 => 'Reinstall packages',
              1 => 'HTML',
              2 => 'SQL',
              3 => 'Log',
            ),
            'correct' => 0,
          ),
          6 => 
          array (
            'text' => 'What does from datetime import datetime give?',
            'options' => 
            array (
              0 => 'The datetime class',
              1 => 'Today\'s date',
              2 => 'UTC only',
              3 => 'JSON',
            ),
            'correct' => 0,
          ),
          7 => 
          array (
            'text' => 'What is the re module for?',
            'options' => 
            array (
              0 => 'Regex',
              1 => 'Random',
              2 => 'Request',
              3 => 'Redis',
            ),
            'correct' => 0,
          ),
          8 => 
          array (
            'text' => 'What does pip install django do?',
            'options' => 
            array (
              0 => 'Installs Django',
              1 => 'Creates a project',
              2 => 'migrate',
              3 => 'runserver',
            ),
            'correct' => 0,
          ),
          9 => 
          array (
            'text' => 'What is __all__ for from module import *?',
            'options' => 
            array (
              0 => 'Exported names',
              1 => 'All files',
              2 => 'Class only',
              3 => 'Function only',
            ),
            'correct' => 0,
          ),
        ),
      ),
    ),
    10 => 
    array (
      'ru' => 
      array (
        'title' => 'Тест: Введение в Django',
        'questions' => 
        array (
          0 => 
          array (
            'text' => 'На каком языке написан Django?',
            'options' => 
            array (
              0 => 'Python',
              1 => 'JavaScript',
              2 => 'PHP',
              3 => 'Ruby',
            ),
            'correct' => 0,
          ),
          1 => 
          array (
            'text' => 'Что означает M в MVT?',
            'options' => 
            array (
              0 => 'Model',
              1 => 'Module',
              2 => 'Middleware',
              3 => 'Manager',
            ),
            'correct' => 0,
          ),
          2 => 
          array (
            'text' => 'Команда создания проекта?',
            'options' => 
            array (
              0 => 'django-admin startproject',
              1 => 'pip start django',
              2 => 'python new django',
              3 => 'django create',
            ),
            'correct' => 0,
          ),
          3 => 
          array (
            'text' => 'Что делает runserver?',
            'options' => 
            array (
              0 => 'Запускает dev-сервер',
              1 => 'migrate',
              2 => 'collectstatic',
              3 => 'test',
            ),
            'correct' => 0,
          ),
          4 => 
          array (
            'text' => 'Что такое manage.py?',
            'options' => 
            array (
              0 => 'Точка входа Django CLI',
              1 => 'Модель',
              2 => 'Шаблон',
              3 => 'URL',
            ),
            'correct' => 0,
          ),
          5 => 
          array (
            'text' => 'Что создаёт startapp?',
            'options' => 
            array (
              0 => 'Структуру приложения (app)',
              1 => 'PostgreSQL',
              2 => 'nginx',
              3 => 'React',
            ),
            'correct' => 0,
          ),
          6 => 
          array (
            'text' => 'Где находится INSTALLED_APPS?',
            'options' => 
            array (
              0 => 'settings.py',
              1 => 'urls.py',
              2 => 'views.py',
              3 => 'wsgi.py',
            ),
            'correct' => 0,
          ),
          7 => 
          array (
            'text' => 'Зачем нужен migrate?',
            'options' => 
            array (
              0 => 'Применить схему БД',
              1 => 'Перезапуск сервера',
              2 => 'Static',
              3 => 'Email',
            ),
            'correct' => 0,
          ),
          8 => 
          array (
            'text' => 'Откуда импортировать HttpResponse?',
            'options' => 
            array (
              0 => 'django.http',
              1 => 'django.db',
              2 => 'django.forms',
              3 => 'django.admin',
            ),
            'correct' => 0,
          ),
          9 => 
          array (
            'text' => 'URL панели admin обычно?',
            'options' => 
            array (
              0 => '/admin/',
              1 => '/dashboard/',
              2 => '/api/',
              3 => '/login/ only',
            ),
            'correct' => 0,
          ),
        ),
      ),
      'en' => 
      array (
        'title' => 'Test: Django Introduction',
        'questions' => 
        array (
          0 => 
          array (
            'text' => 'What language is Django written in?',
            'options' => 
            array (
              0 => 'Python',
              1 => 'JavaScript',
              2 => 'PHP',
              3 => 'Ruby',
            ),
            'correct' => 0,
          ),
          1 => 
          array (
            'text' => 'What does M stand for in MVT?',
            'options' => 
            array (
              0 => 'Model',
              1 => 'Module',
              2 => 'Middleware',
              3 => 'Manager',
            ),
            'correct' => 0,
          ),
          2 => 
          array (
            'text' => 'Command to create a project?',
            'options' => 
            array (
              0 => 'django-admin startproject',
              1 => 'pip start django',
              2 => 'python new django',
              3 => 'django create',
            ),
            'correct' => 0,
          ),
          3 => 
          array (
            'text' => 'What does runserver do?',
            'options' => 
            array (
              0 => 'Starts the dev server',
              1 => 'migrate',
              2 => 'collectstatic',
              3 => 'test',
            ),
            'correct' => 0,
          ),
          4 => 
          array (
            'text' => 'What is manage.py?',
            'options' => 
            array (
              0 => 'Django CLI entry point',
              1 => 'Model',
              2 => 'Template',
              3 => 'URL',
            ),
            'correct' => 0,
          ),
          5 => 
          array (
            'text' => 'What does startapp create?',
            'options' => 
            array (
              0 => 'App structure',
              1 => 'PostgreSQL',
              2 => 'nginx',
              3 => 'React',
            ),
            'correct' => 0,
          ),
          6 => 
          array (
            'text' => 'Where is INSTALLED_APPS?',
            'options' => 
            array (
              0 => 'settings.py',
              1 => 'urls.py',
              2 => 'views.py',
              3 => 'wsgi.py',
            ),
            'correct' => 0,
          ),
          7 => 
          array (
            'text' => 'What is migrate for?',
            'options' => 
            array (
              0 => 'Apply DB schema',
              1 => 'Restart server',
              2 => 'Static',
              3 => 'Email',
            ),
            'correct' => 0,
          ),
          8 => 
          array (
            'text' => 'Where to import HttpResponse from?',
            'options' => 
            array (
              0 => 'django.http',
              1 => 'django.db',
              2 => 'django.forms',
              3 => 'django.admin',
            ),
            'correct' => 0,
          ),
          9 => 
          array (
            'text' => 'Admin panel URL is usually?',
            'options' => 
            array (
              0 => '/admin/',
              1 => '/dashboard/',
              2 => '/api/',
              3 => '/login/ only',
            ),
            'correct' => 0,
          ),
        ),
      ),
    ),
    11 => 
    array (
      'ru' => 
      array (
        'title' => 'Тест: Модели Django и ORM',
        'questions' => 
        array (
          0 => 
          array (
            'text' => 'Где пишется Model?',
            'options' => 
            array (
              0 => 'models.py',
              1 => 'views.py',
              2 => 'urls.py',
              3 => 'admin.py only',
            ),
            'correct' => 0,
          ),
          1 => 
          array (
            'text' => 'Что делает makemigrations?',
            'options' => 
            array (
              0 => 'Создаёт файлы миграций',
              1 => 'Удаляет БД',
              2 => 'runserver',
              3 => 'test',
            ),
            'correct' => 0,
          ),
          2 => 
          array (
            'text' => 'Для чего CharField?',
            'options' => 
            array (
              0 => 'Короткий текст',
              1 => 'Большой текст',
              2 => 'Число',
              3 => 'Дата',
            ),
            'correct' => 0,
          ),
          3 => 
          array (
            'text' => 'Что такое ForeignKey?',
            'options' => 
            array (
              0 => 'Связь многие-к-одному',
              1 => 'Один-к-одному',
              2 => 'JSON',
              3 => 'File only',
            ),
            'correct' => 0,
          ),
          4 => 
          array (
            'text' => 'Что означает on_delete=CASCADE?',
            'options' => 
            array (
              0 => 'При удалении родителя удаляются связанные',
              1 => 'NULL',
              2 => 'Ничего',
              3 => 'Protect only name',
            ),
            'correct' => 0,
          ),
          5 => 
          array (
            'text' => 'Что возвращает Article.objects.filter()?',
            'options' => 
            array (
              0 => 'QuerySet',
              1 => 'dict',
              2 => 'list only SQL',
              3 => 'HttpResponse',
            ),
            'correct' => 0,
          ),
          6 => 
          array (
            'text' => 'Зачем нужен __str__?',
            'options' => 
            array (
              0 => 'Отображение в admin/shell',
              1 => 'URL',
              2 => 'migrate',
              3 => 'CSRF',
            ),
            'correct' => 0,
          ),
          7 => 
          array (
            'text' => 'Что означает auto_now_add=True?',
            'options' => 
            array (
              0 => 'Автоматически время создания',
              1 => 'Обновление',
              2 => 'Удаление',
              3 => 'Slug',
            ),
            'correct' => 0,
          ),
          8 => 
          array (
            'text' => 'Что делает get_object_or_404?',
            'options' => 
            array (
              0 => '404 если объект не найден',
              1 => '500',
              2 => 'redirect',
              3 => 'JSON',
            ),
            'correct' => 0,
          ),
          9 => 
          array (
            'text' => 'Что значит QuerySet lazy?',
            'options' => 
            array (
              0 => 'SQL не выполняется до обращения',
              1 => 'Быстрый',
              2 => 'Кеш',
              3 => 'Пустой',
            ),
            'correct' => 0,
          ),
        ),
      ),
      'en' => 
      array (
        'title' => 'Test: Django Models and ORM',
        'questions' => 
        array (
          0 => 
          array (
            'text' => 'Where is a Model written?',
            'options' => 
            array (
              0 => 'models.py',
              1 => 'views.py',
              2 => 'urls.py',
              3 => 'admin.py only',
            ),
            'correct' => 0,
          ),
          1 => 
          array (
            'text' => 'What does makemigrations do?',
            'options' => 
            array (
              0 => 'Creates migration files',
              1 => 'Deletes DB',
              2 => 'runserver',
              3 => 'test',
            ),
            'correct' => 0,
          ),
          2 => 
          array (
            'text' => 'What is CharField for?',
            'options' => 
            array (
              0 => 'Short text',
              1 => 'Long text',
              2 => 'Number',
              3 => 'Date',
            ),
            'correct' => 0,
          ),
          3 => 
          array (
            'text' => 'What is ForeignKey?',
            'options' => 
            array (
              0 => 'Many-to-one relation',
              1 => 'One-to-one',
              2 => 'JSON',
              3 => 'File only',
            ),
            'correct' => 0,
          ),
          4 => 
          array (
            'text' => 'What does on_delete=CASCADE mean?',
            'options' => 
            array (
              0 => 'Related objects deleted with parent',
              1 => 'NULL',
              2 => 'Nothing',
              3 => 'Protect only name',
            ),
            'correct' => 0,
          ),
          5 => 
          array (
            'text' => 'What does Article.objects.filter() return?',
            'options' => 
            array (
              0 => 'QuerySet',
              1 => 'dict',
              2 => 'list only SQL',
              3 => 'HttpResponse',
            ),
            'correct' => 0,
          ),
          6 => 
          array (
            'text' => 'What is __str__ for?',
            'options' => 
            array (
              0 => 'Display in admin/shell',
              1 => 'URL',
              2 => 'migrate',
              3 => 'CSRF',
            ),
            'correct' => 0,
          ),
          7 => 
          array (
            'text' => 'What does auto_now_add=True mean?',
            'options' => 
            array (
              0 => 'Auto-set creation time',
              1 => 'Update',
              2 => 'Delete',
              3 => 'Slug',
            ),
            'correct' => 0,
          ),
          8 => 
          array (
            'text' => 'What does get_object_or_404 do?',
            'options' => 
            array (
              0 => '404 if object not found',
              1 => '500',
              2 => 'redirect',
              3 => 'JSON',
            ),
            'correct' => 0,
          ),
          9 => 
          array (
            'text' => 'What does QuerySet lazy mean?',
            'options' => 
            array (
              0 => 'SQL not executed until accessed',
              1 => 'Fast',
              2 => 'Cache',
              3 => 'Empty',
            ),
            'correct' => 0,
          ),
        ),
      ),
    ),
    12 => 
    array (
      'ru' => 
      array (
        'title' => 'Тест: Представления Django и URL',
        'questions' => 
        array (
          0 => array ('text' => 'Что возвращает render()?', 'options' => array (0 => 'HttpResponse (HTML)', 1 => 'JSON only', 2 => 'Model', 3 => 'QuerySet'), 'correct' => 0),
          1 => array ('text' => 'Что означает path("<int:pk>/")?', 'options' => array (0 => 'Конвертер — целочисленный pk', 1 => 'str pk', 2 => 'slug', 3 => 'uuid only'), 'correct' => 0),
          2 => array ('text' => 'Что делает include()?', 'options' => array (0 => 'Подключает другой urls.py', 1 => 'Шаблон', 2 => 'Static', 3 => 'Model'), 'correct' => 0),
          3 => array ('text' => 'Что такое ListView?', 'options' => array (0 => 'Class-based view для списка', 1 => 'Form', 2 => 'Serializer', 3 => 'Middleware'), 'correct' => 0),
          4 => array ('text' => 'request.method POST означает?', 'options' => array (0 => 'Отправка формы', 1 => 'Только чтение', 2 => 'DELETE only', 3 => 'PATCH only'), 'correct' => 0),
          5 => array ('text' => 'Что делает reverse()?', 'options' => array (0 => 'URL по имени', 1 => 'redirect view', 2 => 'Model', 3 => 'Template'), 'correct' => 0),
          6 => array ('text' => 'Что такое JsonResponse?', 'options' => array (0 => 'JSON API ответ', 1 => 'HTML', 2 => 'File', 3 => 'Redirect'), 'correct' => 0),
          7 => array ('text' => 'name="article_list" — это?', 'options' => array (0 => 'Имя URL для reverse', 1 => 'Имя модели', 2 => 'View class', 3 => 'Template'), 'correct' => 0),
          8 => array ('text' => 'Откуда импортировать get_object_or_404?', 'options' => array (0 => 'django.shortcuts', 1 => 'django.http', 2 => 'django.db', 3 => 'django.forms'), 'correct' => 0),
          9 => array ('text' => 'Что показывает DetailView?', 'options' => array (0 => 'Один объект', 1 => 'Список', 2 => 'Form', 3 => 'Admin'), 'correct' => 0),
        ),
      ),
      'en' => 
      array (
        'title' => 'Test: Django Views and URL',
        'questions' => 
        array (
          0 => array ('text' => 'What does render() return?', 'options' => array (0 => 'HttpResponse (HTML)', 1 => 'JSON only', 2 => 'Model', 3 => 'QuerySet'), 'correct' => 0),
          1 => array ('text' => 'What does path("<int:pk>/") mean?', 'options' => array (0 => 'Converter — integer pk', 1 => 'str pk', 2 => 'slug', 3 => 'uuid only'), 'correct' => 0),
          2 => array ('text' => 'What does include() do?', 'options' => array (0 => 'Include another urls.py', 1 => 'Template', 2 => 'Static', 3 => 'Model'), 'correct' => 0),
          3 => array ('text' => 'What is ListView?', 'options' => array (0 => 'Class-based list view', 1 => 'Form', 2 => 'Serializer', 3 => 'Middleware'), 'correct' => 0),
          4 => array ('text' => 'request.method POST means?', 'options' => array (0 => 'Form submission', 1 => 'Read only', 2 => 'DELETE only', 3 => 'PATCH only'), 'correct' => 0),
          5 => array ('text' => 'What does reverse() do?', 'options' => array (0 => 'URL from name', 1 => 'redirect view', 2 => 'Model', 3 => 'Template'), 'correct' => 0),
          6 => array ('text' => 'What is JsonResponse?', 'options' => array (0 => 'JSON API response', 1 => 'HTML', 2 => 'File', 3 => 'Redirect'), 'correct' => 0),
          7 => array ('text' => 'name="article_list" is?', 'options' => array (0 => 'URL name for reverse', 1 => 'Model name', 2 => 'View class', 3 => 'Template'), 'correct' => 0),
          8 => array ('text' => 'Where to import get_object_or_404 from?', 'options' => array (0 => 'django.shortcuts', 1 => 'django.http', 2 => 'django.db', 3 => 'django.forms'), 'correct' => 0),
          9 => array ('text' => 'What does DetailView show?', 'options' => array (0 => 'One object', 1 => 'List', 2 => 'Form', 3 => 'Admin'), 'correct' => 0),
        ),
      ),
    ),
    13 => 
    array (
      'ru' => 
      array (
        'title' => 'Тест: Шаблоны Django',
        'questions' => 
        array (
          0 => array ('text' => 'Что делает {{ variable }}?', 'options' => array (0 => 'Вывод значения', 1 => 'Python код', 2 => 'Comment', 3 => 'Import'), 'correct' => 0),
          1 => array ('text' => 'Что делает {% csrf_token %}?', 'options' => array (0 => 'CSRF защита', 1 => 'CSS', 2 => 'SQL', 3 => 'Session'), 'correct' => 0),
          2 => array ('text' => 'Что делает {% extends %}?', 'options' => array (0 => 'Наследование базового шаблона', 1 => 'Цикл', 2 => 'If', 3 => 'Static'), 'correct' => 0),
          3 => array ('text' => 'Что делает фильтр |upper?', 'options' => array (0 => 'Верхний регистр', 1 => 'Нижний', 2 => 'Обрезка', 3 => 'JSON'), 'correct' => 0),
          4 => array ('text' => '{% for %} {% empty %} — когда?', 'options' => array (0 => 'Если список пуст', 1 => 'Ошибка', 2 => 'Break', 3 => 'Include'), 'correct' => 0),
          5 => array ('text' => 'Что делает {% load static %}?', 'options' => array (0 => 'Тег static файлов', 1 => 'Model', 2 => 'URL', 3 => 'Form'), 'correct' => 0),
          6 => array ('text' => 'APP_DIRS: True означает?', 'options' => array (0 => 'Ищет app templates/', 1 => 'Static only', 2 => 'DB', 3 => 'Cache'), 'correct' => 0),
          7 => array ('text' => 'Что такое {% block content %}?', 'options' => array (0 => 'Заменяемый блок при наследовании', 1 => 'If', 2 => 'For', 3 => 'URL'), 'correct' => 0),
          8 => array ('text' => 'Что делает |truncatewords?', 'options' => array (0 => 'Обрезает по числу слов', 1 => 'HTML safe', 2 => 'Date', 3 => 'Upper'), 'correct' => 0),
          9 => array ('text' => 'Зачем нужно наследование шаблонов?', 'options' => array (0 => 'Уменьшить повторение', 1 => 'SQL', 2 => 'migrate', 3 => 'pip'), 'correct' => 0),
        ),
      ),
      'en' => 
      array (
        'title' => 'Test: Django Templates',
        'questions' => 
        array (
          0 => array ('text' => 'What does {{ variable }} do?', 'options' => array (0 => 'Output a value', 1 => 'Python code', 2 => 'Comment', 3 => 'Import'), 'correct' => 0),
          1 => array ('text' => 'What does {% csrf_token %} do?', 'options' => array (0 => 'CSRF protection', 1 => 'CSS', 2 => 'SQL', 3 => 'Session'), 'correct' => 0),
          2 => array ('text' => 'What does {% extends %} do?', 'options' => array (0 => 'Inherit base template', 1 => 'Loop', 2 => 'If', 3 => 'Static'), 'correct' => 0),
          3 => array ('text' => 'What does the |upper filter do?', 'options' => array (0 => 'Uppercase', 1 => 'Lowercase', 2 => 'Truncate', 3 => 'JSON'), 'correct' => 0),
          4 => array ('text' => '{% for %} {% empty %} — when?', 'options' => array (0 => 'When list is empty', 1 => 'Error', 2 => 'Break', 3 => 'Include'), 'correct' => 0),
          5 => array ('text' => 'What does {% load static %} do?', 'options' => array (0 => 'Static files tag', 1 => 'Model', 2 => 'URL', 3 => 'Form'), 'correct' => 0),
          6 => array ('text' => 'APP_DIRS: True means?', 'options' => array (0 => 'Search app templates/', 1 => 'Static only', 2 => 'DB', 3 => 'Cache'), 'correct' => 0),
          7 => array ('text' => 'What is {% block content %}?', 'options' => array (0 => 'Replaceable block in inheritance', 1 => 'If', 2 => 'For', 3 => 'URL'), 'correct' => 0),
          8 => array ('text' => 'What does |truncatewords do?', 'options' => array (0 => 'Truncate by word count', 1 => 'HTML safe', 2 => 'Date', 3 => 'Upper'), 'correct' => 0),
          9 => array ('text' => 'Why use template inheritance?', 'options' => array (0 => 'Reduce duplication', 1 => 'SQL', 2 => 'migrate', 3 => 'pip'), 'correct' => 0),
        ),
      ),
    ),
    14 => 
    array (
      'ru' => 
      array (
        'title' => 'Тест: Формы Django и Admin',
        'questions' => 
        array (
          0 => array ('text' => 'Что такое ModelForm?', 'options' => array (0 => 'Форма из модели', 1 => 'Только email', 2 => 'API', 3 => 'Middleware'), 'correct' => 0),
          1 => array ('text' => 'Что делает form.is_valid()?', 'options' => array (0 => 'Валидация', 1 => 'save()', 2 => 'render', 3 => 'migrate'), 'correct' => 0),
          2 => array ('text' => 'Что такое cleaned_data?', 'options' => array (0 => 'Очищенный ввод', 1 => 'POST raw', 2 => 'GET', 3 => 'Session'), 'correct' => 0),
          3 => array ('text' => 'Что такое list_display в admin?', 'options' => array (0 => 'Колонки списка', 1 => 'Filter only', 2 => 'Search', 3 => 'Inline'), 'correct' => 0),
          4 => array ('text' => 'Что такое TabularInline?', 'options' => array (0 => 'Связанная модель в admin', 1 => 'Form widget', 2 => 'URL', 3 => 'Template tag'), 'correct' => 0),
          5 => array ('text' => 'Что такое forms.ValidationError?', 'options' => array (0 => 'Ошибка ручной валидации', 1 => '404', 2 => '500', 3 => 'CSRF'), 'correct' => 0),
          6 => array ('text' => 'Что делает messages.success?', 'options' => array (0 => 'Сообщение пользователю', 1 => 'Email', 2 => 'Log only', 3 => 'JSON'), 'correct' => 0),
          7 => array ('text' => 'Что делает {{ form.as_p }}?', 'options' => array (0 => 'HTML формы в параграфах', 1 => 'JSON', 2 => 'PDF', 3 => 'CSV'), 'correct' => 0),
          8 => array ('text' => 'Что такое search_fields в admin?', 'options' => array (0 => 'Поиск в admin', 1 => 'Model field', 2 => 'URL', 3 => 'View'), 'correct' => 0),
          9 => array ('text' => 'Что такое request.POST?', 'options' => array (0 => 'POST данные', 1 => 'GET', 2 => 'Files only', 3 => 'Headers'), 'correct' => 0),
        ),
      ),
      'en' => 
      array (
        'title' => 'Test: Django Forms and Admin',
        'questions' => 
        array (
          0 => array ('text' => 'What is ModelForm?', 'options' => array (0 => 'Form from model', 1 => 'Email only', 2 => 'API', 3 => 'Middleware'), 'correct' => 0),
          1 => array ('text' => 'What does form.is_valid() do?', 'options' => array (0 => 'Validation', 1 => 'save()', 2 => 'render', 3 => 'migrate'), 'correct' => 0),
          2 => array ('text' => 'What is cleaned_data?', 'options' => array (0 => 'Sanitized input', 1 => 'POST raw', 2 => 'GET', 3 => 'Session'), 'correct' => 0),
          3 => array ('text' => 'What is list_display in admin?', 'options' => array (0 => 'List columns', 1 => 'Filter only', 2 => 'Search', 3 => 'Inline'), 'correct' => 0),
          4 => array ('text' => 'What is TabularInline?', 'options' => array (0 => 'Related model in admin', 1 => 'Form widget', 2 => 'URL', 3 => 'Template tag'), 'correct' => 0),
          5 => array ('text' => 'What is forms.ValidationError?', 'options' => array (0 => 'Manual validation error', 1 => '404', 2 => '500', 3 => 'CSRF'), 'correct' => 0),
          6 => array ('text' => 'What does messages.success do?', 'options' => array (0 => 'User message', 1 => 'Email', 2 => 'Log only', 3 => 'JSON'), 'correct' => 0),
          7 => array ('text' => 'What does {{ form.as_p }} do?', 'options' => array (0 => 'Form HTML in paragraphs', 1 => 'JSON', 2 => 'PDF', 3 => 'CSV'), 'correct' => 0),
          8 => array ('text' => 'What is search_fields in admin?', 'options' => array (0 => 'Admin search', 1 => 'Model field', 2 => 'URL', 3 => 'View'), 'correct' => 0),
          9 => array ('text' => 'What is request.POST?', 'options' => array (0 => 'POST data', 1 => 'GET', 2 => 'Files only', 3 => 'Headers'), 'correct' => 0),
        ),
      ),
    ),
    15 => 
    array (
      'ru' => 
      array (
        'title' => 'Тест: Аутентификация Django и REST API',
        'questions' => 
        array (
          0 => array ('text' => 'Что делает login_required?', 'options' => array (0 => 'Перенаправляет неавторизованных на login', 1 => 'Admin only', 2 => 'CSRF', 3 => 'API key'), 'correct' => 0),
          1 => array ('text' => 'Что делает authenticate()?', 'options' => array (0 => 'Проверяет логин/пароль', 1 => 'Token JWT', 2 => 'OAuth only', 3 => 'Session delete'), 'correct' => 0),
          2 => array ('text' => 'Название пакета DRF?', 'options' => array (0 => 'djangorestframework', 1 => 'django-api', 2 => 'rest-django', 3 => 'django-json'), 'correct' => 0),
          3 => array ('text' => 'Что такое ModelSerializer?', 'options' => array (0 => 'Model ↔ JSON', 1 => 'HTML', 2 => 'Form', 3 => 'Admin'), 'correct' => 0),
          4 => array ('text' => 'Что такое ViewSet?', 'options' => array (0 => 'Набор CRUD API views', 1 => 'Template', 2 => 'Middleware', 3 => 'Migration'), 'correct' => 0),
          5 => array ('text' => 'DEBUG=False в production — это?', 'options' => array (0 => 'Best practice безопасности', 1 => 'Быстрый dev', 2 => 'Удаление admin', 3 => 'Удаление static'), 'correct' => 0),
          6 => array ('text' => 'Что такое ALLOWED_HOSTS?', 'options' => array (0 => 'Разрешённые домены', 1 => 'DB host', 2 => 'Email', 3 => 'Redis'), 'correct' => 0),
          7 => array ('text' => 'Что делает collectstatic?', 'options' => array (0 => 'Собирает static файлы', 1 => 'migrate', 2 => 'test', 3 => 'shell'), 'correct' => 0),
          8 => array ('text' => 'Что такое DefaultRouter?', 'options' => array (0 => 'Автоматические API URL', 1 => 'Form', 2 => 'Template', 3 => 'Model'), 'correct' => 0),
          9 => array ('text' => 'Что делает createsuperuser?', 'options' => array (0 => 'Создаёт admin пользователя', 1 => 'Student', 2 => 'API token', 3 => 'migrate'), 'correct' => 0),
        ),
      ),
      'en' => 
      array (
        'title' => 'Test: Django Authentication and REST API',
        'questions' => 
        array (
          0 => array ('text' => 'What does login_required do?', 'options' => array (0 => 'Redirects unauthenticated users to login', 1 => 'Admin only', 2 => 'CSRF', 3 => 'API key'), 'correct' => 0),
          1 => array ('text' => 'What does authenticate() do?', 'options' => array (0 => 'Checks login/password', 1 => 'Token JWT', 2 => 'OAuth only', 3 => 'Session delete'), 'correct' => 0),
          2 => array ('text' => 'DRF package name?', 'options' => array (0 => 'djangorestframework', 1 => 'django-api', 2 => 'rest-django', 3 => 'django-json'), 'correct' => 0),
          3 => array ('text' => 'What is ModelSerializer?', 'options' => array (0 => 'Model ↔ JSON', 1 => 'HTML', 2 => 'Form', 3 => 'Admin'), 'correct' => 0),
          4 => array ('text' => 'What is ViewSet?', 'options' => array (0 => 'CRUD API view set', 1 => 'Template', 2 => 'Middleware', 3 => 'Migration'), 'correct' => 0),
          5 => array ('text' => 'DEBUG=False in production is?', 'options' => array (0 => 'Security best practice', 1 => 'Fast dev', 2 => 'Remove admin', 3 => 'Remove static'), 'correct' => 0),
          6 => array ('text' => 'What is ALLOWED_HOSTS?', 'options' => array (0 => 'Allowed domains', 1 => 'DB host', 2 => 'Email', 3 => 'Redis'), 'correct' => 0),
          7 => array ('text' => 'What does collectstatic do?', 'options' => array (0 => 'Collect static files', 1 => 'migrate', 2 => 'test', 3 => 'shell'), 'correct' => 0),
          8 => array ('text' => 'What is DefaultRouter?', 'options' => array (0 => 'Automatic API URLs', 1 => 'Form', 2 => 'Template', 3 => 'Model'), 'correct' => 0),
          9 => array ('text' => 'What does createsuperuser do?', 'options' => array (0 => 'Creates admin user', 1 => 'Student', 2 => 'API token', 3 => 'migrate'), 'correct' => 0),
        ),
      ),
    ),
  ),
  'assignments' => 
  array (
    8 => 
    array (
      0 => 
      array (
        'ru' => 
        array (
          'title' => 'Чтение и запись файла',
          'description' => 'Напишите программу, которая читает data.txt и записывает результат в output.txt',
        ),
        'en' => 
        array (
          'title' => 'File read and write',
          'description' => 'Write a program that reads data.txt and writes the result to output.txt',
        ),
      ),
      1 => 
      array (
        'ru' => 
        array (
          'title' => 'Использование try-except',
          'description' => 'Напишите программу с вводом числа — перехватите ZeroDivisionError и ValueError',
        ),
        'en' => 
        array (
          'title' => 'Using try-except',
          'description' => 'Write a program that reads a number — catch ZeroDivisionError and ValueError',
        ),
      ),
    ),
    9 => 
    array (
      0 => 
      array (
        'ru' => 
        array (
          'title' => 'Импорт модулей',
          'description' => 'Напишите скрипт, использующий модули math, random и datetime',
        ),
        'en' => 
        array (
          'title' => 'Importing modules',
          'description' => 'Write a script using the math, random, and datetime modules',
        ),
      ),
      1 => 
      array (
        'ru' => 
        array (
          'title' => 'requirements.txt',
          'description' => 'В venv сохраните результат pip freeze в файл requirements.txt',
        ),
        'en' => 
        array (
          'title' => 'requirements.txt',
          'description' => 'In a venv, save pip freeze output to requirements.txt',
        ),
      ),
    ),
    10 => 
    array (
      0 => 
      array (
        'ru' => 
        array (
          'title' => 'Установка Django-проекта',
          'description' => 'Создайте проект через django-admin startproject и запустите runserver',
        ),
        'en' => 
        array (
          'title' => 'Django project setup',
          'description' => 'Create a project with django-admin startproject and run runserver',
        ),
      ),
      1 => 
      array (
        'ru' => 
        array (
          'title' => 'Первый view',
          'description' => 'Создайте home view, возвращающий HttpResponse, и привяжите URL',
        ),
        'en' => 
        array (
          'title' => 'First view',
          'description' => 'Create a home view returning HttpResponse and wire up the URL',
        ),
      ),
    ),
    11 => 
    array (
      0 => 
      array (
        'ru' => 
        array (
          'title' => 'Модель Article',
          'description' => 'Создайте модель Article с полями title, content, created_at и выполните migrate',
        ),
        'en' => 
        array (
          'title' => 'Article model',
          'description' => 'Create an Article model with title, content, created_at and run migrate',
        ),
      ),
      1 => 
      array (
        'ru' => 
        array (
          'title' => 'Регистрация в Admin',
          'description' => 'Добавьте модель Article в admin panel и введите 2 статьи',
        ),
        'en' => 
        array (
          'title' => 'Admin registration',
          'description' => 'Register Article in the admin panel and add 2 articles',
        ),
      ),
    ),
    12 => 
    array (
      0 => 
      array (
        'ru' => 
        array (
          'title' => 'Article list view',
          'description' => 'Создайте view и URL для отображения всех статей',
        ),
        'en' => 
        array (
          'title' => 'Article list view',
          'description' => 'Create a view and URL to display all articles',
        ),
      ),
      1 => 
      array (
        'ru' => 
        array (
          'title' => 'Detail view',
          'description' => 'Создайте detail view для отображения одной статьи по pk',
        ),
        'en' => 
        array (
          'title' => 'Detail view',
          'description' => 'Create a detail view to show one article by pk',
        ),
      ),
    ),
    13 => 
    array (
      0 => 
      array (
        'ru' => 
        array (
          'title' => 'base.html',
          'description' => 'Создайте base.html и list.html с наследованием шаблонов',
        ),
        'en' => 
        array (
          'title' => 'base.html',
          'description' => 'Create base.html and list.html using template inheritance',
        ),
      ),
      1 => 
      array (
        'ru' => 
        array (
          'title' => 'Static CSS',
          'description' => 'Подключите CSS файл в шаблон через {% load static %}',
        ),
        'en' => 
        array (
          'title' => 'Static CSS',
          'description' => 'Include a CSS file in a template using {% load static %}',
        ),
      ),
    ),
    14 => 
    array (
      0 => 
      array (
        'ru' => 
        array (
          'title' => 'ContactForm',
          'description' => 'Создайте ContactForm с полями name, email, message и view',
        ),
        'en' => 
        array (
          'title' => 'ContactForm',
          'description' => 'Create a ContactForm with name, email, message fields and a view',
        ),
      ),
      1 => 
      array (
        'ru' => 
        array (
          'title' => 'ModelForm',
          'description' => 'Создайте ModelForm для Article и сохраняйте через POST',
        ),
        'en' => 
        array (
          'title' => 'ModelForm',
          'description' => 'Create a ModelForm for Article and save via POST',
        ),
      ),
    ),
    15 => 
    array (
      0 => 
      array (
        'ru' => 
        array (
          'title' => 'Защита login',
          'description' => 'Создайте dashboard view с декоратором @login_required',
        ),
        'en' => 
        array (
          'title' => 'Login protection',
          'description' => 'Create a dashboard view with the @login_required decorator',
        ),
      ),
      1 => 
      array (
        'ru' => 
        array (
          'title' => 'DRF API',
          'description' => 'Создайте endpoint /api/articles/ через ArticleSerializer и ViewSet',
        ),
        'en' => 
        array (
          'title' => 'DRF API',
          'description' => 'Create a /api/articles/ endpoint using ArticleSerializer and ViewSet',
        ),
      ),
    ),
  ),
);
