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

    public function updateAssignment(Request $request, $sid, $assid)
    {
        $request->validate([
        'score' => 'nullable|numeric|min:0',
        'feedback' => 'nullable|string|max:1000',
        ]);

        Submission::where('assid', $assid)
          ->where('sid', $sid)
          ->update([
              'score' => $request->score,
              'feedback' => $request->feedback,
          ]);


        return redirect()->back()->with('success', '作業評分成功');
    }

}