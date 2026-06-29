<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GolfCourseController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

// ログイン中の画面
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('golf-courses.index');
    });

    Route::get('golf-courses/trashed', [GolfCourseController::class, 'trashed'])
        ->name('golf-courses.trashed');

    Route::get('golf-courses/{golfCourse}/delete', [GolfCourseController::class, 'delete'])
        ->name('golf-courses.delete');

    Route::post('golf-courses/{golfCourse}/restore', [GolfCourseController::class, 'restore'])
        ->name('golf-courses.restore')
        ->withTrashed();

    Route::delete('golf-courses/{golfCourse}/force', [GolfCourseController::class, 'forceDelete'])
        ->name('golf-courses.force-delete')
        ->withTrashed();

    Route::resource('golf-courses', GolfCourseController::class);

    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});
