<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Course;

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

}