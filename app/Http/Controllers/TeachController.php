<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TeachController extends Controller
{

    public function index()
    {
        $teacherId = Auth::guard('teacher')->user()->tid;

        $courses = Course::withCount('enrollments')
            ->where('tid', $teacherId)
            ->get();

        return view('teach.index', compact('courses'));
    }

    public function manage(Request $request)
    {
        $teacherId = Auth::guard('teacher')->user()->tid;
        $courses = Course::where('tid', $teacherId)->get();

        return view('teach.manage.announcement', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cid' => 'required|exists:course,cid',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
    
        DB::table('announcement')->insert([
            'cid' => $request->cid,
            'title' => $request->title,
            'content' => $request->content,
            'timestamp' => now(),
        ]);

    
        $emails = DB::table('enrollment')
            ->join('student', 'enrollment.sid', '=', 'student.sid')
            ->where('enrollment.cid', $request->cid)
            ->pluck('student.email');
        
        foreach ($emails as $email) {
    
            Mail::raw("您參加的課程有一則新公告：\n\n標題：{$request->title}\n內容：{$request->content}", 
            function ($message) use ($email) {
                $message->to($email)
                        ->subject('課程新公告');
            });
        }
    
        return redirect()->back()->with('success', '公告已成功儲存並寄出 email');
    }

}