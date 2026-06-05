@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Список групп</h1>

<ul>
    @foreach ($groups as $group)
        <li class="mb-2">
            <a href="{{ route('teacher.groups.lessons', $group->id) }}" class="text-blue-600 hover:underline">
                {{ $group->name }}
            </a>
        </li>
    @endforeach
</ul>
@endsection
