<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\TA;


class TAController extends Controller
{
    public function index()
    {
        $studentId = Auth::guard('student')->user()->sid;

        $tas = TA::where('sid', $studentId)->with('course')->get();

        $courses = $tas->pluck('course')->filter(); // 避免 null

        return view('learn.manage.ta.list', compact('courses'));
    }
}
