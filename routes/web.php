<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\TukarKoinController;
use App\Http\Controllers\EdukasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\MapsController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ConnectionController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Route for the Auth page
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process');
Route::get('/login/google', [AuthController::class, 'googleLogin'])->name('google.login');
Route::get('/login/google/step1', [AuthController::class, 'googleStep1'])->name('google.step1');
Route::get('/login/manual', [AuthController::class, 'loginManual'])->name('login.manual');
Route::get('/login/manual/step1', [AuthController::class, 'loginManualStep1'])->name('manual.step1');
Route::get('/daftar', [AuthController::class, 'daftar'])->name('daftar');
Route::post('/daftar', [AuthController::class, 'register'])->name('register.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/forgot/password', [AuthController::class, 'forgotPassword'])->name('forgot.password');
Route::get('/forgot/password/verifikasi', [AuthController::class, 'forgotPasswordVerifikasi'])->name('forgot.password.verifikasi');
Route::get('/forgot/password/new', [AuthController::class, 'forgotPasswordNew'])->name('forgot.password.new');

// Routes Halaman Beranda
Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda')->middleware('check.login');

// Routes Halaman Tukar Koin
Route::get('/tukar-koin', [TukarKoinController::class, 'index'])->name('tukar-koin')->middleware('check.login');
Route::post('/tukar-koin/exchange', [TukarKoinController::class, 'exchange'])->name('tukar-koin.exchange')->middleware('check.login');

// Routes Halaman Edukasi
Route::get('/edukasi', [EdukasiController::class, 'index'])->name('edukasi');
Route::get('/edukasi/artikel/{id}', [EdukasiController::class, 'show'])->name('edukasi.artikel');

// Routes Halaman Maps
Route::get('/maps', [MapsController::class, 'cariMesin'])->name('maps.cari-mesin-1');
Route::get('/maps/notfound', [MapsController::class, 'notFound'])->name('maps.cari-mesin-2');
Route::get('/maps/notactive', [MapsController::class, 'notActive'])->name('maps.cari-mesin-3');


// Routes Halaman Profile
Route::middleware('check.login')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile_index');
    Route::get('/profile/data-profile', [ProfileController::class, 'detail'])->name('profile_detail');
    Route::get('/profile/keamanan', [ProfileController::class, 'changepass'])->name('profile_changepass');
    Route::get('/profile/rekening', [ProfileController::class, 'changerekening'])->name('profile_changerekening');
    Route::get('/profile/kebijakan', [ProfileController::class, 'kebijakanprivasi'])->name('profile_kebijakanprivasi');
    Route::get('/profile/syarat', [ProfileController::class, 'syaratketentuan'])->name('profile_syaratketentuan');
    
    // Profile picture upload routes
    Route::post('/profile/upload-picture', [ProfileController::class, 'uploadProfilePicture'])->name('profile.upload.picture');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
});

// Route Halaman History
Route::middleware('check.login')->group(function () {
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    Route::get('/history/transaksi/{id}', [HistoryController::class, 'detailTransaksi'])->name('history_detail-transaksi');
    Route::get('/history/transaksi-2/{id}', [HistoryController::class, 'detailTransaksiDua'])->name('history_detail-transaksi-2');
    Route::get('/history/transaksi-3/{id}', [HistoryController::class, 'detailTransaksiTiga'])->name('history_detail-transaksi-3');
    Route::get('/history/transaksi-4/{id}', [HistoryController::class, 'detailTransaksiEmpat'])->name('history_detail-transaksi-4');
    Route::get('/history/transaksi-5/{id}', [HistoryController::class, 'detailTransaksiLima'])->name('history_detail-transaksi-5');
    Route::get('/history/transaksi-6/{id}', [HistoryController::class, 'detailTransaksiEnam'])->name('history_detail-transaksi-6');
});

// Route Halaman Donasi
Route::middleware('check.login')->group(function () {
    Route::get('/donasi', [DonasiController::class, 'index'])->name('donasi.index');
    Route::get('/donasi/biodata', [DonasiController::class, 'BiodataDonatur'])->name('donasi.biodata');
    Route::post('/donasi/bukti-tf', [DonasiController::class, 'BuktiTF'])->name('donasi.bukti-tf');
    Route::get('/donasi/upload-bukti', [DonasiController::class, 'UploadBuktiTF'])->name('donasi.upload-bukti');
});

// Scan
Route::get('/scan', [ScanController::class, 'index'])->name('scan.index')->middleware('check.login');

// Route Halaman Games
Route::middleware('check.login')->group(function () {
    Route::get('/games', [GamesController::class, 'index'])->name('games.index');
    Route::get('/games/challenge', [GamesController::class, 'challenge'])->name('games.challenge');
});

// test
Route::get('/test/add-users', [UsersController::class, 'addUsers'])->name('test.add-users');
Route::post('/test/users/store', [UsersController::class, 'store'])->name('users.store');
Route::get('/test/add-statistic', [StatisticController::class, 'addStatistic'])->name('test.add-statistic');
Route::post('/test/statistic/store', [StatisticController::class, 'store'])->name('statistic.store');
Route::get('/test/view-statistics', [StatisticController::class, 'viewStatistics'])->name('test.view-statistics');
Route::get('/test/add-connection', [ConnectionController::class, 'addConnection'])->name('test.add-connection');
Route::post('/test/connection/store', [ConnectionController::class, 'store'])->name('connection.store');
Route::get('/test/view-connections', [ConnectionController::class, 'viewConnections'])->name('test.view-connections');

// API
Route::get('/saldo/add', [BalanceController::class, 'add'])->name('saldo.add');