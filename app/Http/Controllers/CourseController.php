<?php

namespace App\Http\Controllers;

use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    public function show($cid)
    {
        $course = Course::with('teacher')->findOrFail($cid);
        return view('courses.show', compact('course'));
    }

}
