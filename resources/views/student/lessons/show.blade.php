@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col bg-gradient-to-b from-green-50 to-white">

    <header class="bg-white shadow-md p-5 flex justify-between items-center sticky top-0 z-10">
        <h1 class="text-3xl font-extrabold text-green-700 tracking-wide">{{ $lesson->translate('title') }}</h1>
        <a href="{{ route('student.dashboard') }}" class="text-green-600 hover:underline">Назад к списку уроков</a>
    </header>

    <main class="flex-1 p-8 overflow-y-auto bg-white min-h-0 rounded-tr-xl rounded-br-xl shadow-inner">

        <article class="mb-6 text-green-800 leading-relaxed">
            {!! nl2br(e($lesson->translate('content'))) !!}
        </article>

        @if ($lesson->pdf_path)
            <a href="{{ asset('storage/' . $lesson->pdf_path) }}" target="_blank" class="mb-6 inline-block text-green-600 hover:underline">Открыть материал (PDF)</a>
        @endif

        <section class="mb-10">
            <h2 class="text-2xl font-semibold mb-4 text-green-700">Задания</h2>

            @forelse ($lesson->assignments as $assignment)
                <div class="mb-6 p-4 border border-green-300 rounded bg-green-50">
                    <h3 class="font-bold text-lg text-green-800 mb-2">{{ $assignment->translate('title') }}</h3>
                    <p class="mb-3 text-green-700">{{ $assignment->translate('description') }}</p>

                    @php
                        $submission = $assignment->submissions->first();
                    @endphp

                    @if ($submission)
                        <p class="text-green-600 mb-2">Вы уже отправили задание.</p>
                        <p>Оценка: {{ $submission->grade ?? 'Ожидается' }}</p>
                        <p>Отзыв: {{ $submission->feedback ?? 'Отзыв пока отсутствует' }}</p>
                    @else
                        <form action="{{ route('student.assignments.submit', $assignment->id) }}" method="POST" enctype="multipart/form-data" class="mb-0">
                            @csrf
                            <label class="block mb-2 font-semibold text-green-700" for="submission_file_{{ $assignment->id }}">Загрузить домашнее задание (архив):</label>
                            <input type="file" name="submission_file" id="submission_file_{{ $assignment->id }}" accept=".zip,.rar,.7z" required class="mb-3 border border-green-300 rounded px-3 py-2 w-full max-w-xs">
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded shadow">Отправить</button>
                        </form>
                    @endif
                </div>
            @empty
                <p class="italic text-green-400">Заданий нет.</p>
            @endforelse
        </section>

        <section>
            <h2 class="text-2xl font-semibold mb-4 text-green-700">Комментарии</h2>

            <form action="{{ route('student.lessons.comments.store', $lesson->id) }}" method="POST" class="mb-6">
                @csrf
                <input type="hidden" name="submission_id" value="{{ $submission->id }}">

                <textarea name="comment" rows="3" required
                    class="w-full p-3 border border-green-300 rounded resize-none focus:outline-none focus:ring-2 focus:ring-green-400"
                    placeholder="Оставьте комментарий к уроку"></textarea>
                <button type="submit" class="mt-2 bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded shadow">Отправить комментарий</button>
            </form>

            @if($lesson->comments->count())
                <ul>
                    @foreach ($lesson->comments as $comment)
                        <li class="mb-4 border border-green-200 rounded p-3 bg-green-50">
                            <p class="text-green-800 font-semibold">{{ $comment->user->name }} <span class="text-green-600 text-sm">{{ $comment->created_at->diffForHumans() }}</span></p>
                            <p class="text-green-700">{{ $comment->comment }}</p>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="italic text-green-400">Комментарии отсутствуют.</p>
            @endif
        </section>

    </main>
</div>
@endsection
