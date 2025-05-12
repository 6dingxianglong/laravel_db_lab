<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Enrollment;
use Illuminate\Support\Facades\DB;

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
        $announcements = DB::table('announcement')
            ->where('cid', $cid)
            ->orderByDesc('timestamp')
            ->get();
    
        $enrollment = Enrollment::where('cid', $cid)->firstOrFail();
        $course = $enrollment->course; 
                
        return view('learn.manage.list', compact('announcements', 'course'));
    }
}
