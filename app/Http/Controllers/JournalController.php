<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    public function index(Request $request)
    {
        $lessons = Lesson::with(['assignments.submissions.user'])
            ->orderByDesc('created_at')
            ->paginate(10);

        $students = User::where('role', 'student')->orderBy('name')->get();

        return view('journal.index', compact('lessons', 'students'));
    }
}
