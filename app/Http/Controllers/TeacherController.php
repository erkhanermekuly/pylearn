<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lesson;
use App\Notifications\SubmissionFeedbackNotification;
use App\Models\Submission;

class TeacherController extends Controller
{
    public function dashboard()
    {
        $lessons = Lesson::with(['assignments.submissions.user', 'test'])
            ->orderByDesc('created_at')
            ->get();

        $students = User::where('role', 'student')->orderBy('name')->get();

        return view('teacher.dashboard', compact('lessons', 'students'));
    }

    public function viewSubmission(Submission $submission)
    {
        $submission->load(['user', 'assignment.lesson.test', 'comments.user']);
        return view('teacher.submission_view', compact('submission'));
    }

    public function updateSubmission(Request $request, Submission $submission)
    {
        $validated = $request->validate([
            'feedback' => 'nullable|string',
            'grade' => 'nullable|integer|min:0|max:100',
        ]);

        $submission->update($validated);

        if (!empty($validated['feedback']) || isset($validated['grade'])) {
            $submission->user->notify(new SubmissionFeedbackNotification($submission));
        }

        return redirect()->route('teacher.submission.view', $submission)->with('success', 'Комментарий и оценка обновлены');
    }
}
