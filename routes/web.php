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
use App\Http\Controllers\KamarController;
use App\Http\Controllers\TipeKamarController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\FakturController;

Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/landing', [LandingController::class, 'index'])->name('landing');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('guest:tamu')->group(function () {
    Route::get('/login_tamu', [RegisterTamuController::class, 'showLoginForm'])->name('login.tamu');
    Route::post('/login_tamu', [RegisterTamuController::class, 'login'])->name('login.tamu.post');
    Route::get('/register-tamu', [RegisterTamuController::class, 'showRegisterForm'])->name('register.tamu');
    Route::post('/register-tamu', [RegisterTamuController::class, 'register'])->name('register.tamu.post');
});

Route::post('/logout-tamu', [RegisterTamuController::class, 'logout'])
    ->middleware('auth:tamu')
    ->name('logout.tamu');

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/statistik_admin', [StatistikController::class, 'tampilkanHalaman'])
        ->name('statistik.admin');

    // Verifikasi pemesanan (konfirmasi / tolak reservasi)
    Route::get('/verifikasi_admin', [VerifikasiController::class, 'index'])
        ->name('verifikasi.admin');
    Route::post('/verifikasi/{id}', [VerifikasiController::class, 'approve'])
        ->name('verifikasi.approve');
    Route::post('/verifikasi/{id}/tolak', [VerifikasiController::class, 'tolak'])
        ->name('verifikasi.tolak');

    // Verifikasi pembayaran
    Route::get('/verifikasi_pembayaran', [PembayaranController::class, 'index'])
        ->name('verifikasi.pembayaran');
    Route::get('/verifikasi_pembayaran/{id}', [PembayaranController::class, 'detail'])
        ->name('pembayaran.detail');
    Route::post('/verifikasi_pembayaran/{id}/verifikasi', [PembayaranController::class, 'verifikasi'])
        ->name('pembayaran.verifikasi');
});

Route::middleware(['auth', 'role:admin,resepsionis'])->group(function () {

    // Data kamar — ini sekaligus jadi halaman "beranda" resepsionis setelah login
    Route::get('/data_kamar', [KamarController::class, 'index'])
        ->name('data.kamar');

    Route::get('/data_reservasi', function () {
        return view('pages.data_reservasi', [
            'reservasis'     => [],
            'totalPemesanan' => 0,
            'menunggu'       => 0,
            'dikonfirmasi'   => 0,
            'dibatalkan'     => 0,
        ]);
    })->name('data.reservasi');

    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update.put');

    Route::resource('kamar', KamarController::class)->except(['index']);
    Route::resource('tipe-kamar', TipeKamarController::class);
});

Route::middleware('auth:tamu')->group(function () {

    Route::get('/dashboard_tamu', [DashboardTamuController::class, 'index'])
        ->name('dashboard.tamu');

    Route::get('/pemesanan', [PemesananController::class, 'showPemesanan'])
        ->name('pemesanan');
    Route::post('/pemesanan', [PemesananController::class, 'store'])
        ->name('pemesanan.store');
    Route::post('/pemesanan/{id}/batalkan', [PemesananController::class, 'batalkan'])
        ->name('pemesanan.batalkan');

    Route::get('/profil', [ProfilTamuController::class, 'index'])
        ->name('profil');
    Route::put('/profil', [ProfilTamuController::class, 'update'])
        ->name('profil.update');

    Route::get('/invoice/{id}', [ProfilTamuController::class, 'showInvoice'])
        ->name('invoice.show');

    // Faktur tamu
    Route::get('/faktur/{id_reservasi}', [FakturController::class, 'show'])
        ->name('faktur.show');
    Route::get('/faktur/{id_reservasi}/cetak', [FakturController::class, 'cetak'])
        ->name('faktur.cetak');

    // Pembayaran tamu (upload bukti transfer)
    Route::get('/faktur/{no_faktur}/bayar', [PembayaranController::class, 'bayarForm'])
        ->name('pembayaran.bayar.form');
    Route::post('/faktur/{no_faktur}/bayar', [PembayaranController::class, 'bayar'])
        ->name('pembayaran.bayar');
});