@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Добавить задание для урока "{{ $lesson->title }}"</h1>

<form method="POST" action="{{ route('teacher.assignments.store', $lesson->id) }}">
    @csrf
    <label class="block mb-2 font-medium">Название задания</label>
    <input type="text" name="title" class="w-full mb-4 p-2 border rounded" required>

    <label class="block mb-2 font-medium">Описание задания</label>
    <textarea name="description" rows="5" class="w-full mb-4 p-2 border rounded" required></textarea>

    <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Сохранить</button>
</form>
@endsection
