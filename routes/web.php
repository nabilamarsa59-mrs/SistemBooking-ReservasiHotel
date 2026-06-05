<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardTamuController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\RegisterTamuController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\ProfilTamuController;


Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/landing', [LandingController::class, 'index'])->name('landing');

// Hapus middleware('guest') dan ganti dengan logika manual di AuthController
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::middleware('guest:tamu')->group(function () {
    Route::get('/login_tamu', [RegisterTamuController::class, 'showLoginForm'])->name('login.tamu');
    Route::post('/login_tamu', [RegisterTamuController::class, 'login'])->name('login.tamu.post');
    Route::get('/register-tamu', [RegisterTamuController::class, 'showRegisterForm'])->name('register.tamu');
    Route::post('/register-tamu', [RegisterTamuController::class, 'register'])->name('register.tamu.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/logout-tamu', [RegisterTamuController::class, 'logout'])
    ->middleware('auth:tamu')
    ->name('logout.tamu');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/statistik_admin', [StatistikController::class, 'tampilkanHalaman'])
        ->name('statistik.admin');
    Route::get('/verifikasi_admin', [VerifikasiController::class, 'index'])
        ->name('verifikasi.admin');
    Route::post('/verifikasi/{id}', [VerifikasiController::class, 'approve'])
        ->name('verifikasi.approve');
    Route::get('/data_kamar', function () {
        return view('pages.data_kamar');
    })->name('data.kamar');
    Route::get('/data_reservasi', function () {
        return view('pages.data_reservasi');
    })->name('data.reservasi');
});

Route::middleware(['auth', 'role:resepsionis'])->group(function () {
    Route::get('/home_resepsionis', function () {
        return view('pages.home_resepsionis');
    })->name('home.resepsionis');
    Route::get('/data_reservasi', function () {
        return view('pages.data_reservasi');
    })->name('data.reservasi.resepsionis');
});

Route::middleware('auth:tamu')->group(function () {
    Route::get('/dashboard_tamu', [DashboardTamuController::class, 'index'])
        ->name('dashboard.tamu');
    Route::post('/pemesanan', [PemesananController::class, 'store'])
        ->name('pemesanan.store');
    Route::get('/pemesanan', [PemesananController::class, 'showPemesanan'])
        ->name('pemesanan');
    Route::get('/profil', [ProfilTamuController::class, 'index'])
        ->name('profil');
    Route::put('/profil', [ProfilTamuController::class, 'update'])
        ->name('profil.update');
    Route::get('/invoice/{id}', [ProfilTamuController::class, 'showInvoice'])
        ->name('invoice.show');
});

Route::middleware(['auth', 'role:admin,resepsionis'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
});