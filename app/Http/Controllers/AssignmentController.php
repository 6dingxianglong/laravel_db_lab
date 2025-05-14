<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Assignment;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function addAssignment(Request $request)
    {
        $courses = $this->getManageableCourses();

        return view('teach.manage.assignment.create', compact('courses'));
    }

    public function storeAssignment(Request $request)
    {
        $request->validate([
            'cid' => 'required|exists:course,cid',
            'title' => 'required|string',
            'description' => 'required|string',
            'deadline' => 'required|date',
        ]);

        Assignment::create([
            'cid' => $request->cid,
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
        ]);

        return redirect()->back()->with('success', '作業已成功儲存')->with('selected_cid', $request->cid);
    }

    public function listAssignment($cid)
    {
        $assignments = Assignment::where('cid', $cid)
            ->orderByDesc('deadline')
            ->get();
    
        $course = Course::findOrFail($cid);
    
        return view('teach.manage.assignment.list', compact('assignments', 'course'));
    }

    public function editAssignment($assid)
    {
        $assignment = Assignment::findOrFail($assid);
        return view('teach.manage.assignment.edit', compact('assignment'));
    }

    public function updateAssignment(Request $request, $assid)
    {
        $request->validate([
            'cid' => 'required|exists:course,cid',
            'title' => 'required|string',
            'description' => 'required|string',
            'deadline' => 'required|date',
        ]);

        $assignment = Assignment::findOrFail($assid);
        $assignment->update([
            'cid' => $request->cid,
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
        ]);

        return redirect()->back()->with('success', '作業已更新');
    }

    public function deleteAssignment($assid)
    {
        $assignment = Assignment::findOrFail($assid);
        $assignment->delete();
        
        return redirect()->back()->with('success', '作業已刪除');
    }
}