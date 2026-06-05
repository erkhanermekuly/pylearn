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

        $lessonsForJs = $lessons->map(function (Lesson $lesson) {
            $data = $lesson->toArray();
            $data['title'] = $lesson->translate('title');
            $data['content'] = $lesson->translate('content');

            if ($lesson->test) {
                $data['test'] = $lesson->test->toArray();
                $data['test']['title'] = $lesson->test->localizedTitle();
                $data['test']['questions'] = $lesson->test->localizedQuestions();
            }

            $data['assignments'] = $lesson->assignments->map(function ($assignment) {
                $aData = $assignment->toArray();
                $aData['title'] = $assignment->translate('title');
                $aData['description'] = $assignment->translate('description');

                return $aData;
            })->values()->all();

            return $data;
        })->values();

        return view('teacher.dashboard', compact('lessons', 'students', 'lessonsForJs'));
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

        return redirect()->route('teacher.submission.view', $submission)->with('success', __('messages.flash.feedback_updated'));
    }
}
