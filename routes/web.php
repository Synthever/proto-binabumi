<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

// Route for the login page
Route::get('/login', [LoginController::class, 'index'])->name('login');

// Route for the Google login
Route::get('/login/google', [LoginController::class, 'googleLogin'])->name('google.login');
// Route for the Google login callback
Route::get('/login/google/step1', [LoginController::class, 'googleStep1'])->name('google.step1');