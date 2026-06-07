<?php

return [
    [
        'title' => 'Файлдар мен ерекшеліктер',
        'content' => <<<'TEXT'
Файлдармен жұмыс — деректерді дискіде сақтау және оқу.

Файлды ашу (with — автоматты жабу):
with open("data.txt", "r", encoding="utf-8") as f:
    content = f.read()
    print(content)

Режимдер:
• "r" — оқу (read)
• "w" — жазу, файлды қайта жазады
• "a" — соңына қосу (append)
• "x" — жаңа файл жасау
• "rb" / "wb" — бинарлы режим

Жолма-жол оқу:
with open("log.txt", "r", encoding="utf-8") as f:
    for line in f:
        print(line.strip())

Жазу:
with open("output.txt", "w", encoding="utf-8") as f:
    f.write("Сәлем, Lumina!\n")
    f.writelines(["1-жол\n", "2-жол\n"])

pathlib (заманауи тәсіл):
from pathlib import Path
p = Path("notes.txt")
text = p.read_text(encoding="utf-8")
p.write_text("Жаңа мәтін", encoding="utf-8")

Ерекшеліктер (exceptions) — орындалу барысындағы қателер:
try:
    x = int(input("Сан: "))
    result = 10 / x
except ValueError:
    print("Бұл сан емес!")
except ZeroDivisionError:
    print("Нөлге бөлу мүмкін емес!")
except Exception as e:
    print(f"Қате: {e}")
else:
    print(f"Нәтиже: {result}")
finally:
    print("Блок аяқталды")

raise — қатені қолмен шығару:
if age < 0:
    raise ValueError("Жас теріс болмауы керек")

JSON файлы:
import json
data = {"name": "Асхат", "score": 95}
with open("user.json", "w", encoding="utf-8") as f:
    json.dump(data, f, ensure_ascii=False, indent=2)

with open("user.json", "r", encoding="utf-8") as f:
    loaded = json.load(f)
TEXT,
    ],
    [
        'title' => 'Модульдер мен пакеттер',
        'content' => <<<'TEXT'
Модуль — .py файлы, функциялар мен класстар жинақы.

Импорт:
import math
print(math.sqrt(16))  # 4.0

from datetime import datetime
now = datetime.now()

from collections import Counter as C
C(["a", "b", "a"])

if __name__ == "__main__":
    # Бұл файл тікелей іске қосылғанда ғана орындалады
    main()

Пакет — модульдер бар каталог (__init__.py):
mypackage/
    __init__.py
    utils.py
    models.py

from mypackage.utils import helper

pip — сыртқы пакеттер менеджері:
pip install requests
pip install django
pip list
pip freeze > requirements.txt
pip install -r requirements.txt

Виртуальды орта (venv):
python -m venv venv
# Windows: venv\Scripts\activate
# Linux/macOS: source venv/bin/activate
deactivate

Стандартты модульдер:
• os, sys — жүйемен жұмыс
• random — кездейсоқ сандар
• re — regex
• json — JSON
• pathlib — жолдар

Пакет құрылымы best practice:
project/
    src/
        app/
    tests/
    requirements.txt
    README.md

__all__ — экспортталатын атаулар тізімі (from module import * үшін).
TEXT,
    ],
    [
        'title' => 'Django таныстыру және орнату',
        'content' => <<<'TEXT'
Django — Python-да жазылған толық стек веб-фреймворк. Instagram, Pinterest сияқты жобалар Django қолданған.

Неге Django:
• «Бatteries included» — ORM, admin, auth, forms дайын
• Қауіпсіздік (CSRF, XSS, SQL injection қорғанысы)
• Масштабталу және жылдам даму
• Көптеген документация

MVT архитектурасы:
• Model — деректер мен бизнес-логика (ORM)
• View — сұрауды өңдеу, жауап қайтару
• Template — HTML көрініс

Орнату:
python -m venv venv
venv\Scripts\activate
pip install django
django-admin --version

Жоба жасау:
django-admin startproject lumina_site
cd lumina_site
python manage.py runserver

Құрылым:
lumina_site/
    manage.py
    lumina_site/
        settings.py
        urls.py
        wsgi.py
    (apps/)

Қосымша (app) жасау:
python manage.py startapp blog

settings.py — INSTALLED_APPS ішіне 'blog' қосу.

Бірінші view (blog/views.py):
from django.http import HttpResponse

def home(request):
    return HttpResponse("<h1>Lumina Django</h1>")

URL (lumina_site/urls.py):
from django.contrib import admin
from django.urls import path
from blog import views

urlpatterns = [
    path('admin/', admin.site.urls),
    path('', views.home),
]

python manage.py migrate — деректер базасын дайындау.
python manage.py createsuperuser — admin пайдаланушысы.
TEXT,
    ],
    [
        'title' => 'Django модельдері және ORM',
        'content' => <<<'TEXT'
Django ORM — Python код арқылы SQL жазбай деректермен жұмыс.

Модель (blog/models.py):
from django.db import models

class Article(models.Model):
    title = models.CharField(max_length=200)
    content = models.TextField()
    created_at = models.DateTimeField(auto_now_add=True)
    is_published = models.BooleanField(default=False)

    class Meta:
        ordering = ['-created_at']

    def __str__(self):
        return self.title

Миграция:
python manage.py makemigrations
python manage.py migrate

Admin (blog/admin.py):
from django.contrib import admin
from .models import Article

@admin.register(Article)
class ArticleAdmin(admin.ModelAdmin):
    list_display = ['title', 'is_published', 'created_at']
    list_filter = ['is_published']

Shell:
python manage.py shell
>>> from blog.models import Article
>>> Article.objects.create(title="Python", content="...")
>>> Article.objects.filter(is_published=True)
>>> Article.objects.get(pk=1)

Сұрау әдістері:
• all(), filter(field=value), exclude()
• get(pk=1) — бір объект
• order_by('-created_at')
• count(), first(), last()

Қатынастар:
class Author(models.Model):
    name = models.CharField(max_length=100)

class Book(models.Model):
    author = models.ForeignKey(Author, on_delete=models.CASCADE)
    title = models.CharField(max_length=200)

# book.author, author.book_set.all()

on_delete: CASCADE, SET_NULL, PROTECT

QuerySet lazy — шақырғанша SQL орындалmayды.
TEXT,
    ],
    [
        'title' => 'Django көріністері мен URL',
        'content' => <<<'TEXT'
View — HTTP сұрауды қабылдап, HttpResponse қайтарады.

Функциялық view:
from django.http import HttpResponse, JsonResponse
from django.shortcuts import render, get_object_or_404
from .models import Article

def article_list(request):
    articles = Article.objects.filter(is_published=True)
    return render(request, 'blog/list.html', {'articles': articles})

def article_detail(request, pk):
    article = get_object_or_404(Article, pk=pk)
    return render(request, 'blog/detail.html', {'article': article})

Class-Based View (CBV):
from django.views.generic import ListView, DetailView

class ArticleListView(ListView):
    model = Article
    template_name = 'blog/list.html'
    context_object_name = 'articles'
    queryset = Article.objects.filter(is_published=True)

URL маршруттау (blog/urls.py):
from django.urls import path
from . import views

urlpatterns = [
    path('', views.article_list, name='article_list'),
    path('<int:pk>/', views.article_detail, name='article_detail'),
]

Негізгі urls.py:
path('blog/', include('blog.urls')),

path конвертерлері: int, str, slug, uuid, path

request объекті:
• request.method — GET, POST
• request.GET, request.POST
• request.user — аутентификацияланған пайдаланушы

JsonResponse API үшін:
return JsonResponse({'status': 'ok', 'count': 10})

redirect және reverse:
from django.shortcuts import redirect
from django.urls import reverse
return redirect('article_list')
TEXT,
    ],
    [
        'title' => 'Django шаблондары (Templates)',
        'content' => <<<'TEXT'
Django Template Language (DTL) — HTML ішінде динамикалық мазмұн.

settings.py:
TEMPLATES = [{
    'DIRS': [BASE_DIR / 'templates'],
    'APP_DIRS': True,
    ...
}]

templates/blog/list.html:
<!DOCTYPE html>
<html>
<body>
  <h1>Мақалалар</h1>
  {% for article in articles %}
    <article>
      <h2>{{ article.title }}</h2>
      <p>{{ article.content|truncatewords:30 }}</p>
    </article>
  {% empty %}
    <p>Мақала жоқ.</p>
  {% endfor %}
</body>
</html>

Тегтер:
{% if user.is_authenticated %}Сәлем, {{ user.username }}{% endif %}
{% for item in list %}...{% endfor %}
{% extends "base.html" %}
{% block content %}...{% endblock %}
{% include "partials/nav.html" %}

Сүзгiler (filters):
{{ name|upper }}
{{ text|truncatewords:20 }}
{{ value|date:"d.m.Y" }}
{{ html|safe }}  # абайла!

Мұра etу (base.html):
<!DOCTYPE html>
<html>
<head><title>{% block title %}Lumina{% endblock %}</title></head>
<body>
  {% block content %}{% endblock %}
</body>
</html>

Кontext processors — әр шаблонға global айнымалылар (settings.py TEMPLATES OPTIONS).

Static файлдар:
{% load static %}
<link rel="stylesheet" href="{% static 'css/style.css' %}">

STATIC_URL = 'static/'
STATICFILES_DIRS = [BASE_DIR / 'static']

Custom template tags — {% load blog_tags %} арқылы кеңейтіледі.
TEXT,
    ],
    [
        'title' => 'Django формалары және Admin',
        'content' => <<<'TEXT'
Formalar — пайдаланушы енгізуін валидациялау.

Қарапайым Form (forms.py):
from django import forms

class ContactForm(forms.Form):
    name = forms.CharField(max_length=100, label="Аты")
    email = forms.EmailField()
    message = forms.CharField(widget=forms.Textarea)

View:
def contact(request):
    if request.method == 'POST':
        form = ContactForm(request.POST)
        if form.is_valid():
            # form.cleaned_data['name']
            return redirect('success')
    else:
        form = ContactForm()
    return render(request, 'contact.html', {'form': form})

Шаблон:
<form method="post">
  {% csrf_token %}
  {{ form.as_p }}
  <button type="submit">Жіберу</button>
</form>

ModelForm — модельден автоматты форма:
class ArticleForm(forms.ModelForm):
    class Meta:
        model = Article
        fields = ['title', 'content', 'is_published']

Admin кеңейту:
class ArticleAdmin(admin.ModelAdmin):
    search_fields = ['title', 'content']
    prepopulated_fields = {'slug': ('title',)}
    readonly_fields = ['created_at']
    fieldsets = (
        ('Негізгі', {'fields': ('title', 'content')}),
        ('Басқа', {'fields': ('is_published',)}),
    )

Inline admin (ForeignKey):
class CommentInline(admin.TabularInline):
    model = Comment
    extra = 1

Валидация:
def clean_email(self):
    email = self.cleaned_data['email']
    if not email.endswith('.kz'):
        raise forms.ValidationError('Email .kz доменinde болуы керек')
    return email

messages framework — хабарламалар:
from django.contrib import messages
messages.success(request, 'Сақталды!')
TEXT,
    ],
    [
        'title' => 'Django аутентификация және REST API',
        'content' => <<<'TEXT'
Аутентификация — Django auth жүйесі.

createsuperuser, LoginView, LogoutView:
from django.contrib.auth import login, logout, authenticate
from django.contrib.auth.decorators import login_required

@login_required
def dashboard(request):
    return render(request, 'dashboard.html')

settings.py:
LOGIN_URL = '/accounts/login/'
LOGIN_REDIRECT_URL = '/'

User моделі: django.contrib.auth.models.User
Кастом user: AUTH_USER_MODEL = 'accounts.CustomUser'

Пароль: user.set_password('secret'); user.save()
authenticate(username='x', password='y')

Permissions:
@permission_required('blog.change_article')
user.has_perm('blog.add_article')

Django REST Framework (DRF):
pip install djangorestframework
INSTALLED_APPS += ['rest_framework']

Serializer:
from rest_framework import serializers

class ArticleSerializer(serializers.ModelSerializer):
    class Meta:
        model = Article
        fields = ['id', 'title', 'content', 'created_at']

ViewSet:
from rest_framework import viewsets

class ArticleViewSet(viewsets.ModelViewSet):
    queryset = Article.objects.all()
    serializer_class = ArticleSerializer

Router (urls.py):
from rest_framework.routers import DefaultRouter
router = DefaultRouter()
router.register('articles', ArticleViewSet)
urlpatterns += router.urls

API: GET /api/articles/, POST /api/articles/

Deployment негіздері:
• DEBUG = False production-да
• ALLOWED_HOSTS = ['yourdomain.com']
• SECRET_KEY қауіпсіз сақтау
• collectstatic, gunicorn + nginx
• PostgreSQL production DB

python manage.py check — конфигурацияны тексеру.
TEXT,
    ],
];
