<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GolfCourseController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

// ログイン中の画面
Route::middleware('auth')->group(function () {
    Route::get('/golf-courses',[GolfCourseController::class, 'index']);
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});
