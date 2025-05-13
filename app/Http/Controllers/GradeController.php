<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Course;
use App\Models\Grade;
use App\Models\Assignment;
use App\Models\Submission;
use App\Models\Enrollment;
use App\Models\Student; 

class GradeController extends Controller
{
    public function showCourseAssignments(Request $request)
    {
        $courses = Course::all();
        $selectedCid = $request->input('cid');

        $assignments = [];

        if ($selectedCid) {
            $assignments = Assignment::where('cid', $selectedCid)->get();
        }

        return view('teach.manage.grade.by_course', compact('courses', 'assignments', 'selectedCid'));
    }

    public function showAssignmentGrades($cid, $assid)
    {
        $assignment = Assignment::findOrFail($assid);

        $enrolledSids = Enrollment::where('cid', $cid)->pluck('sid');
        
        $students = Student::whereIn('sid', $enrolledSids)->get();

        $grades = Grade::where('assid', $assid)->get()->keyBy('sid');

        $scoreRanges = array_fill(0, 10, 0); // 10個區間：0-9, 10-19, ..., 90-100

        foreach ($grades as $grade) {
            $score = $grade->score;
            $index = min(intval($score / 10), 9); // 最高分歸類到最後一格
            $scoreRanges[$index]++;
        }

        return view('teach.manage.grade.assignment_grades', compact('assignment', 'students', 'grades', 'cid', 'scoreRanges'));
    }
    
    public function updateOrCreate(Request $request)
    {
        $validated = $request->validate([
            'sid' => 'required|string',
            'cid' => 'required|string',
            'assid' => 'required|integer',
            'score' => 'required|numeric|min:0|max:100',
        ]);

        Grade::updateOrCreate(
            [
                'sid' => $validated['sid'],
                'cid' => $validated['cid'],
                'assid' => $validated['assid'],
            ],
            [
                'score' => $validated['score'],
                "timestamp" => now(),
            ]
        );

        return back()->with('success', '成績已更新');
    }

}