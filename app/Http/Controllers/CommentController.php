<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Lesson $lesson)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        Comment::create([
            'submission_id' => null, 
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);


        return back()->with('success', 'Комментарий добавлен.');
    }
}
