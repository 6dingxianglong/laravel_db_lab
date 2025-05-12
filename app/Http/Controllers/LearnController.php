<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use App\Models\Enrollment;
use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LearnController extends Controller
{
    public function index()
    {
        $studentId = Auth::guard('student')->user()->sid;

        $enrollments = Enrollment::with(['course' => function ($query) {
            $query->withCount('enrollments');
        }])->where('sid', $studentId)->get();

        return view('learn.index', compact('enrollments'));
    }

    public function listAnnouncement($cid)
    {
        $announcements = Announcement::where('cid', $cid)
            ->orderByDesc('timestamp')
            ->get();
    
        $enrollment = Enrollment::where('cid', $cid)->firstOrFail();
        $course = $enrollment->course; 
                
        return view('learn.manage.announcement.list', compact('announcements', 'course'));
    }

    public function listAssignment($cid)
    {
        $assignments = Assignment::where('cid', $cid)
            ->orderByDesc('deadline')
            ->get();
    
        $enrollment = Enrollment::where('cid', $cid)->firstOrFail();
        $course = $enrollment->course; 
                
        return view('learn.manage.assignment.list', compact('assignments', 'course'));
    }

    public function submitAssignment(Request $request) 
    {
        $request->validate([
            'assid' => 'required|exists:assignment,assid',
            'file' => 'required|file|max:10240', // 最大 10MB
        ]);

        $studentId = Auth::guard('student')->user()->sid;

        // 儲存新檔案
        $path = $request->file('file')->store('submissions');

        // 嘗試取得舊的 submission（同一 assid + sid）
        $submission = Submission::where('assid', $request->assid)
                                ->where('sid', $studentId)
                                ->first();

        if ($submission) {
        // 刪除舊檔案
            if (Storage::exists($submission->url)) {
                Storage::delete($submission->url);
            }

            $submission->update([
                'url' => $path,
                'submit_date' => now(),
            ]);
        } else {
            Submission::create([
                'sid' => $studentId,
                'assid' => $request->assid,
                'url' => $path,
                'submit_date' => now(),
            ]);
        }

        return redirect()->back()->with('success', '作業已成功提交' . ($submission ? '（已覆蓋原始檔案）' : ''));
    }

}
