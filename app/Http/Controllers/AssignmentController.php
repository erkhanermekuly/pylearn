<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'teacher') {
            abort(403);
        }

        $data = $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $lesson = Lesson::findOrFail($data['lesson_id']);
        $lesson->assignments()->create([
            'title' => $data['title'],
            'description' => $data['description'],
        ]);

        return redirect()->back()->with('success', 'Задание успешно добавлено');
    }
}
