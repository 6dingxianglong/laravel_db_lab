<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LearnController;
use App\Http\Controllers\TeachController;
use App\Http\Controllers\AssignmentController;
use App\Http\Middleware\RedirectIfSessionExpired;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/news/all', [HomeController::class, 'allNews'])->name('news.all');
Route::get('/courses/all', [HomeController::class, 'allCourses'])->name('courses.all');

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{cid}', [CourseController::class, 'show'])->name('courses.show');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware([RedirectIfSessionExpired::class])->group(function () {
    Route::get('/learn', [LearnController::class, 'index'])->name('learn.index');
    Route::get('/learn/announcement/list/{cid}', [LearnController::class, 'listAnnouncement'])->name('learn.ann.list');

    Route::get('/teach', [TeachController::class, 'index'])->name('teach.index');
    Route::get('/teach/manage/announcement/add', [TeachController::class, 'addAnnouncement'])->name('teach.ann.add');
    Route::post('/teach/manage/announcement/store', [TeachController::class, 'storeAnnouncement'])->name('teach.ann.store');
    Route::get('/teach/manage/announcement/list/{cid}', [TeachController::class, 'listAnnouncement'])->name('teach.ann.list');
    Route::get('/teach/manage/announcement/edit/{annid}', [TeachController::class, 'editAnnouncement'])->name('teach.ann.edit');
    Route::put('/teach/manage/announcement/update/{annid}', [TeachController::class, 'updateAnnouncement'])->name('teach.ann.update');
    Route::delete('/teach/manage/announcement/delete/{annid}', [TeachController::class, 'deleteAnnouncement'])->name('teach.ann.delete');
    Route::get('/teach/manage/assignment/add', [AssignmentController::class, 'addAssignment'])->name('teach.ass.add');
    Route::post('teach/manage/assignment/store', [AssignmentController::class, 'storeAssignment'])->name('teach.ass.store');
    
});
