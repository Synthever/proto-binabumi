<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

// Route for the login page
Route::get('/login', [AuthController::class, 'index'])->name('login');
// Route for the Google login
Route::get('/login/google', [AuthController::class, 'googleLogin'])->name('google.login');
// Route for the Google login callback
Route::get('/login/google/step1', [AuthController::class, 'googleStep1'])->name('google.step1');

// Route for the Daftar page
Route::get('/daftar', [AuthController::class, 'daftar'])->name('daftar');