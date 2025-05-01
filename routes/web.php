<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/news/all', [HomeController::class, 'allNews'])->name('news.all');
Route::get('/courses/all', [HomeController::class, 'allCourses'])->name('courses.all');

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{cid}', [CourseController::class, 'show'])->name('courses.show');

