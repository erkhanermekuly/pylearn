<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Assignment;
use App\Models\User;
use App\Models\Lesson;
use App\Notifications\NewCommentNotification;
use App\Notifications\NewSubmissionNotification;
use App\Services\AiTutorService;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $lessons = Lesson::with(['assignments', 'test'])->orderBy('created_at')->get();

        foreach ($lessons as $lesson) {
            foreach ($lesson->assignments as $assignment) {
                $assignment->submission = $assignment->submission()
                    ->where('user_id', $user->id)
                    ->first();
            }
        }

        return view('student.dashboard', compact('user', 'lessons'));
    }

    public function showLesson($lessonId)
    {
        $student = Auth::user();

        $lesson = Lesson::with(['assignments', 'test'])->findOrFail($lessonId);

        foreach ($lesson->assignments as $assignment) {
            $assignment->submission = $assignment->submission()
                ->where('user_id', $student->id)
                ->with('comments.user')
                ->first();
        }

        return view('student.lesson', compact('lesson'));
    }

    public function submitAssignment(Request $request, $assignmentId)
    {
        $assignment = Assignment::with('submission')->findOrFail($assignmentId);

        $request->validate([
            'code' => 'required|string',
            'archive' => 'nullable|file|mimes:zip,rar,7z|max:20480',
        ]);

        $submission = $assignment->submission ?? new \App\Models\Submission();
        $submission->user_id = auth()->id();
        $submission->assignment_id = $assignment->id;
        $submission->code = $request->input('code');

        if ($request->hasFile('archive')) {
            $path = $request->file('archive')->store('archives', 'public');
            $submission->archive_path = $path;
        }

        $submission->save();

        $teachers = User::where('role', 'teacher')->get();
        foreach ($teachers as $teacher) {
            $teacher->notify(new NewSubmissionNotification($submission));
        }

        return back()->with('success', 'Отправка успешно сохранена.');
    }

    public function addComment(Request $request, $submissionId)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $student = Auth::user();
        $submission = Submission::findOrFail($submissionId);

        if ($submission->user_id !== $student->id) {
            abort(403);
        }

        $comment = $submission->comments()->create([
            'user_id' => $student->id,
            'comment' => $request->comment,
        ]);

        $admins = User::where('role', 'teacher')->get();
        foreach ($admins as $admin) {
            $admin->notify(new NewCommentNotification($comment));
        }

        return redirect()->back()->with('success', 'Комментарий добавлен');
    }

    public function aiChat(Request $request, $lessonId, AiTutorService $ai)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        $lesson = Lesson::findOrFail($lessonId);

        $reply = $ai->chatAboutLesson([
            'lesson_title' => $lesson->title,
            'lesson_content' => $lesson->content,
            'message' => $request->message,
        ]);

        return response()->json(['reply' => $reply]);
    }
}