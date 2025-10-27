<?php

use Illuminate\Support\Facades\Route;
use Modules\Course\Http\Controllers\CourseController;

Route::prefix("course")->group(function () {
    Route::get("/view", [CourseController::class, 'index'])->name('course-view');
    Route::get("/make", [CourseController::class, 'makeCourse'])->name('course-make');
    Route::post("/make", [CourseController::class, 'storeCourse'])->name('course-store');
});
