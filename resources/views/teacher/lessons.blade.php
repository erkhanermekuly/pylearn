@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Уроки группы {{ $group->name }}</h1>

<a href="{{ route('teacher.lessons.create', $group->id) }}" class="mb-4 inline-block bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">
    Добавить урок
</a>

<ul>
    @foreach ($lessons as $lesson)
        <li class="mb-3 p-3 border rounded">
            <h2 class="font-semibold">{{ $lesson->title }}</h2>
            <p>{{ $lesson->content }}</p>
            <a href="{{ route('teacher.assignments.create', $lesson->id) }}" class="text-blue-500 hover:underline">Добавить задание</a>
        </li>
    @endforeach
</ul>
@endsection
