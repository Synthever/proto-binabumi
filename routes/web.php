<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\TukarKoinController;
use App\Http\Controllers\EdukasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\MapsController;

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

// Routes Halaman Beranda
Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');

// Routes Halaman Tukar Koin
Route::get('/tukar-koin', [TukarKoinController::class, 'index'])->name('tukar-koin');
Route::post('/tukar-koin/exchange', [TukarKoinController::class, 'exchange'])->name('tukar-koin.exchange');

// Routes Halaman Edukasi
Route::get('/edukasi', [EdukasiController::class, 'index'])->name('edukasi');

// Routes Halaman Maps
Route::get('/maps', [MapsController::class, 'cariMesin'])->name('maps.cari-mesin-1');
Route::get('/maps/notfound', [MapsController::class, 'notFound'])->name('maps.cari-mesin-2');
Route::get('/maps/notactive', [MapsController::class, 'notActive'])->name('maps.cari-mesin-3');


// Routes Halaman Profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile_index');
Route::get('/profile/detail', [ProfileController::class, 'detail'])->name('profile_detail');
Route::get('/profile/changepass', [ProfileController::class, 'changepass'])->name('profile_changepass');
Route::get('/profile/changerekening', [ProfileController::class, 'changerekening'])->name('profile_changerekening');
Route::get('/profile/kebijakanprivasi', [ProfileController::class, 'kebijakanprivasi'])->name('profile_kebijakanprivasi');
Route::get('/profile/syaratketentuan', [ProfileController::class, 'syaratketentuan'])->name('profile_syaratketentuan');

// Route Halaman History
Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
Route::get('/history/transaksi/{id}', [HistoryController::class, 'detailTransaksi'])->name('history_detail-transaksi');
Route::get('/history/transaksi-2/{id}', [HistoryController::class, 'detailTransaksiDua'])->name('history_detail-transaksi-2');
Route::get('/history/transaksi-3/{id}', [HistoryController::class, 'detailTransaksiTiga'])->name('history_detail-transaksi-3');
Route::get('/history/transaksi-4/{id}', [HistoryController::class, 'detailTransaksiEmpat'])->name('history_detail-transaksi-4');
Route::get('/history/transaksi-5/{id}', [HistoryController::class, 'detailTransaksiLima'])->name('history_detail-transaksi-5');
Route::get('/history/transaksi-6/{id}', [HistoryController::class, 'detailTransaksiEnam'])->name('history_detail-transaksi-6');