<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use App\Models\Enrollment;
use App\Models\Assignment;
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
}
