<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Assignment;
use App\Models\Submission;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        $submission = Submission::with('assignment')
            ->where('assid', $assid)
            ->where('sid', $sid)
            ->first();

        if (!$submission || !$submission->assignment) {
            return redirect()->back()->with('error', '找不到對應的作業或課程');
        }

        $cid = $submission->assignment->cid;

        Grade::updateOrCreate(
        [
                'sid' => $sid,
                'cid' => $cid,
                'assid' => $assid,
            ],
            [
                'score' => $request->score,
                "timestamp" => now(), 
            ]
        );

        return redirect()->back()->with('success', '作業評分成功，並已更新成績紀錄');
    }


    public function sendEmail(Request $request)
    {
        $sid = $request->input('sid'); // 單一學生 ID

        if (empty($sid)) {
            return back()->with('success', '未選擇學生。');
        }

        $submission = Submission::with('student')->where('sid', $sid)->first();

        if (!$submission || !$submission->student) {
            return back()->with('success', '找不到該學生的資料。');
        }

        $student = $submission->student;
        $email = $student->email;

        if ($email) {
            $mailContent = "您參加的課程有一則新消息：\n\n" .
                "標題：{$request->title}\n" .
                "分數：{$request->score}\n" .
                "回饋：{$request->feedback}";

            Mail::raw($mailContent, function ($message) use ($email) {
                $message->to($email)
                    ->subject('作業新消息');
            });

            return back()->with('success', '通知信已成功寄出給 ' . $student->name);
        }

        return back()->with('success', '該學生沒有電子郵件地址。');
    }


}