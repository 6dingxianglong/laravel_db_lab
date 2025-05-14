<?php

namespace App\Http\Controllers;

// app/Http/Controllers/Controller.php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\TA;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    protected function getManageableCourses()
    {
        if (Auth::guard('teacher')->check()) {
            $teacherId = Auth::guard('teacher')->user()->tid;

            return Course::withCount('enrollments')
                ->where('tid', $teacherId)
                ->get();

        } elseif (Auth::guard('student')->check()) {
            $studentId = Auth::guard('student')->user()->sid;

            $taCourseIds = TA::where('sid', $studentId)->pluck('cid');

            return Course::withCount('enrollments')
                ->whereIn('cid', $taCourseIds)
                ->get();
        }

        abort(403, '未授權訪問');
    }
}
