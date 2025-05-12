<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
   public function listSubmission($assid) 
    {
        $assignment = Assignment::findOrFail($assid);

        $submissions = Submission::where('assid', $assid)
                    ->with('student') 
                    ->get();

        $cid = $assignment->cid;

        return view('teach.manage.submission.list', compact('submissions', 'assignment', 'cid'));
    }

public function download($filename)
{
    $path = 'submissions/' . $filename;

    if (!Storage::disk('local')->exists($path)) {
        abort(404, '檔案不存在');
    }

    return Storage::disk('local')->download($path);
}
}