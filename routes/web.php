<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);

// Route for the login page
Route::get('/login', [LoginController::class, 'index'])->name('login');

// Route for the Google login
Route::get('/login/google', [LoginController::class, 'googleLogin'])->name('google.login');
// Route for the Google login callback
Route::get('/login/google/step1', [LoginController::class, 'googleStep1'])->name('google.step1');

// Routes Halaman Profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile_index');

Route::get('/profile/detail', [ProfileController::class, 'detail'])->name('profile_detail');

Route::get('/profile/changepass', [ProfileController::class, 'changepass'])->name('profile_changepass');

Route::get('/profile/changerekening', [ProfileController::class, 'changerekening'])->name('profile_changerekening');

Route::get('/profile/kebijakanprivasi', [ProfileController::class, 'kebijakanprivasi'])->name('profile_kebijakanprivasi');

Route::get('/profile/syaratketentuan', [ProfileController::class, 'syaratketentuan'])->name('profile_syaratketentuan');
