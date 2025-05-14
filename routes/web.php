<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController, CourseController, AuthController, LearnController,
    TeachController, AssignmentController, SubmissionController,
    GradeController, TAController
};
use App\Http\Middleware\RedirectIfSessionExpired;

// 公開頁面
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/news/all', [HomeController::class, 'allNews'])->name('news.all');
Route::get('/courses/all', [HomeController::class, 'allCourses'])->name('courses.all');

Route::prefix('courses')->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/{cid}', [CourseController::class, 'show'])->name('courses.show');
});

// 認證
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::get('/logout', 'logout')->name('logout');
});

// 需登入區域
Route::middleware([RedirectIfSessionExpired::class])->group(function () {

    // 學習區 (Learn)
    Route::prefix('learn')->name('learn.')->group(function () {
        Route::get('/', [LearnController::class, 'index'])->name('index');
        Route::get('/announcement/list/{cid}', [LearnController::class, 'listAnnouncement'])->name('ann.list');
        Route::get('/assignment/list/{cid}', [LearnController::class, 'listAssignment'])->name('ass.list');
        Route::post('/assignment/submit', [LearnController::class, 'submitAssignment'])->name('ass.submit');

        Route::get('/assignments/list', [LearnController::class, 'showCourseAssignments'])->name('assignments');
        Route::get('/assignment/{cid}/{assid}/grades', [LearnController::class, 'showAssignmentGrades'])->name('assignment.grades');

        Route::get('/ta', [TAController::class, 'index'])->name('ta');
    });

    // 教學區 (Teach)
    Route::prefix('teach')->name('teach.')->group(function () {
        Route::get('/', [TeachController::class, 'index'])->name('index');

        // Announcements
        Route::prefix('announcement')->name('ann.')->group(function () {
            Route::get('/add', [TeachController::class, 'addAnnouncement'])->name('add');
            Route::post('/store', [TeachController::class, 'storeAnnouncement'])->name('store');
            Route::get('/list/{cid}', [TeachController::class, 'listAnnouncement'])->name('list');
            Route::get('/edit/{annid}', [TeachController::class, 'editAnnouncement'])->name('edit');
            Route::put('/update/{annid}', [TeachController::class, 'updateAnnouncement'])->name('update');
            Route::delete('/delete/{annid}', [TeachController::class, 'deleteAnnouncement'])->name('delete');
        });

        // Assignments
        Route::prefix('assignment')->name('ass.')->group(function () {
            Route::get('/add', [AssignmentController::class, 'addAssignment'])->name('add');
            Route::post('/store', [AssignmentController::class, 'storeAssignment'])->name('store');
            Route::get('/list/{cid}', [AssignmentController::class, 'listAssignment'])->name('list');
            Route::get('/edit/{assid}', [AssignmentController::class, 'editAssignment'])->name('edit');
            Route::put('/update/{assid}', [AssignmentController::class, 'updateAssignment'])->name('update');
            Route::delete('/delete/{assid}', [AssignmentController::class, 'deleteAssignment'])->name('delete');
        });
    });

    // 作業繳交/批改 (Submission)
    Route::prefix('submission')->name('submission.')->group(function () {
        Route::get('/download/{filename}', [SubmissionController::class, 'download'])->name('download');
        Route::post('/update/{sid}/{assid}', [SubmissionController::class, 'updateAssignment'])->name('update');
        Route::post('/email', [SubmissionController::class, 'sendEmail'])->name('email');
    });

    // 成績管理 (Grade)
    Route::prefix('grades')->name('grade.')->group(function () {
        Route::get('/course/assignments', [GradeController::class, 'showCourseAssignments'])->name('course.assignments');
        Route::get('/assignment/{cid}/{assid}/grades', [GradeController::class, 'showAssignmentGrades'])->name('assignment.grades');
        Route::post('/update', [GradeController::class, 'updateOrCreate'])->name('updateOrCreate');
        Route::get('/export/excel/{cid}/{assid}', [GradeController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export/pdf/{cid}/{assid}', [GradeController::class, 'exportPdf'])->name('export.pdf');
    });

    // 查詢作業繳交名單
    Route::get('/teach/manage/submissions/{assid}', [SubmissionController::class, 'listSubmission'])->name('teach.ass.submissions');
});
