<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardTamuController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VerifikasiController;

Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/landing', [LandingController::class, 'index'])->name('landing');

Route::get('/login-pilihan', [AuthController::class, 'showLoginChoice'])->name('login.choice');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/login_tamu', [AuthController::class, 'showLoginTamu'])->name('login.tamu');
Route::post('/login_tamu', [AuthController::class, 'loginTamu'])->name('login.tamu.post');

Route::get('/dashboard_admin', function () {
    return 'Selamat datang di Dashboard Admin';
})->name('dashboard.admin');

Route::get('/dashboard_resepsionis', function () {
    return 'Selamat datang di Dashboard Resepsionis';
})->name('dashboard.resepsionis');

Route::get('/dashboard_tamu', function () {
    return view('pages.dashboard_tamu');
})->name('dashboard.tamu');

Route::get('/statistik_admin', [StatistikController::class, 'tampilkanHalaman'])->name('statistik.admin');

Route::get('/room', [RoomController::class, 'index']);

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/verifikasi_admin', [VerifikasiController::class, 'index'])->name('verifikasi.admin');