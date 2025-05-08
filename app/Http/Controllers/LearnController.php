<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Enrollment;

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
}
