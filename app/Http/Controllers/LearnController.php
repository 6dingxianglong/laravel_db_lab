<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use App\Models\Enrollment;
use App\Models\Assignment;
use App\Models\Submission;
use App\Models\Grade;
use App\Models\Student;
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

        $path = $request->file('file')->store('submissions');

        $submission = Submission::where('assid', $request->assid)
                                ->where('sid', $studentId)
                                ->first();

        if ($submission) {
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

    public function showCourseAssignments(Request $request)
    {
        $student = Auth::guard('student')->user();
        $enrollments = Enrollment::where('sid', $student->sid)->get();
        $courses = [];
        foreach ($enrollments as $enrollment) {
            $course = $enrollment->course;
            $course->assignments = Assignment::where('cid', $course->cid)->get();
            $courses[] = $course;
        }
        $selectedCid = $request->input('cid');
        $assignments = [];
        if ($selectedCid) {
            $assignments = Assignment::where('cid', $selectedCid)->get();
        }
        return view('learn.manage.grade.by_course', compact('courses', 'assignments', 'selectedCid'));
    }


    public function showAssignmentGrades($cid, $assid)
    {
        $assignment = Assignment::findOrFail($assid);

        $enrolledSids = Enrollment::where('cid', $cid)->pluck('sid');
        $students = Student::whereIn('sid', $enrolledSids)->get();
        $grades = Grade::where('assid', $assid)->get()->keyBy('sid');

        $scoreRanges = array_fill(0, 10, 0); // 成績分布：0-9, 10-19, ..., 90-100

        foreach ($grades as $grade) {
            $score = $grade->score;
            $index = min(intval($score / 10), 9);
            $scoreRanges[$index]++;
        }

        $student = Auth::guard('student')->user(); 
        $myScore = optional($grades->get($student->sid))->score ?? null;

        return view('learn.manage.grade.assignment_grades', compact(
            'assignment', 'students', 'grades', 'cid', 'scoreRanges', 'myScore'
        ));
    }

}
