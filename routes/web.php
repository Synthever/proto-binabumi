<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);

// Route for the Auth page
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/login/google', [AuthController::class, 'googleLogin'])->name('google.login');
Route::get('/login/google/step1', [AuthController::class, 'googleStep1'])->name('google.step1');
Route::get('/login/manual', [AuthController::class, 'loginManual'])->name('login.manual');
Route::get('/login/manual/step1', [AuthController::class, 'loginManualStep1'])->name('manual.step1');
Route::get('/daftar', [AuthController::class, 'daftar'])->name('daftar');
Route::get('/forgot/password', [AuthController::class, 'forgotPassword'])->name('forgot.password');
Route::get('/forgot/password/verifikasi', [AuthController::class, 'forgotPasswordVerifikasi'])->name('forgot.password.verifikasi');

// Routes Halaman Profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile_index');
Route::get('/profile/detail', [ProfileController::class, 'detail'])->name('profile_detail');
Route::get('/profile/changepass', [ProfileController::class, 'changepass'])->name('profile_changepass');
Route::get('/profile/changerekening', [ProfileController::class, 'changerekening'])->name('profile_changerekening');
Route::get('/profile/kebijakanprivasi', [ProfileController::class, 'kebijakanprivasi'])->name('profile_kebijakanprivasi');
Route::get('/profile/syaratketentuan', [ProfileController::class, 'syaratketentuan'])->name('profile_syaratketentuan');