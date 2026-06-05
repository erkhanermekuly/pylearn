<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    public function create()
    {
        if (auth()->user()->role !== 'teacher') {
            abort(403);
        }

        return view('teacher.lessons-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'lesson_title' => 'required|string|max:255',
            'lesson_content' => 'required|string',
            'assignment_title' => 'required|string|max:255',
            'assignment_description' => 'required|string',
            'lesson_pdf' => 'nullable|file|mimes:pdf|max:26000',
        ]);

        $pdfPath = null;
        if ($request->hasFile('lesson_pdf')) {
            $pdfPath = $request->file('lesson_pdf')->store('pdfs', 'public');
        }

        $lesson = Lesson::create([
            'title' => $request->lesson_title,
            'content' => $request->lesson_content,
            'pdf_path' => $pdfPath,
        ]);

        $lesson->assignments()->create([
            'title' => $request->assignment_title,
            'description' => $request->assignment_description,
        ]);

        return redirect()->route('teacher.dashboard')->with('success', __('messages.flash.lesson_uploaded'));
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $lesson = Lesson::findOrFail($id);

            $assignmentIds = DB::table('assignments')->where('lesson_id', $id)->pluck('id');
            if ($assignmentIds->isNotEmpty()) {
                DB::table('submissions')->whereIn('assignment_id', $assignmentIds)->delete();
                DB::table('assignments')->where('lesson_id', $id)->delete();
            }

            $test = DB::table('tests')->where('lesson_id', $id)->first();
            if ($test) {
                DB::table('test_results')->where('test_id', $test->id)->delete();
                DB::table('tests')->where('id', $test->id)->delete();
            }

            if ($lesson->pdf_path && Storage::disk('public')->exists($lesson->pdf_path)) {
                Storage::disk('public')->delete($lesson->pdf_path);
            }

            $lesson->delete();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => __('messages.flash.lesson_deleted')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Өшіру қатесі: " . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => __('messages.flash.delete_error', ['message' => $e->getMessage()])
            ], 500);
        }
    }

    public function createAssignment(Lesson $lesson)
    {
        if (auth()->user()->role !== 'teacher') {
            abort(403);
        }

        return view('teacher.assignments-create', compact('lesson'));
    }

    public function storeAssignment(Request $request, Lesson $lesson)
    {
        if (auth()->user()->role !== 'teacher') {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $lesson->assignments()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('teacher.dashboard')->with('success', __('messages.flash.assignment_added'));
    }

    public function show(Lesson $lesson)
    {
        $lesson->load(['assignments.submissions' => function ($q) {
            $q->where('user_id', auth()->id());
        }, 'comments.user']);

        return view('student.lessons.show', compact('lesson'));
    }
}
