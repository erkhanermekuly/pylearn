<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Support\Facades\Storage;
class SubmissionController extends Controller
{
    
 public function store(Request $request, Assignment $assignment)
    {
        $request->validate([
            'submission_file' => 'required|file|mimes:zip,rar,7z|max:10240',
        ]);


        $path = $request->file('submission_file')->store('submissions');

        $submission = Submission::updateOrCreate(
            [
                'assignment_id' => $assignment->id,
                'user_id' => auth()->id(),
            ],
            [
                'code' => $path,
                'feedback' => null,
                'grade' => null,
            ]
        );

        return back()->with('success', __('messages.flash.homework_submitted'));
    }
}
