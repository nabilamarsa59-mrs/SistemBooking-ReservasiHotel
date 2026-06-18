<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;

class VerifikasiController extends Controller
{
    public function index()
{
    $pembayaran = Pembayaran::all();

    $statistik = [
    'menunggu' => Pembayaran::where('status_pembayaran', 'pending')->count(),

    'terverifikasi' => Pembayaran::where('status_pembayaran', 'lunas')->count(),

    'lunas' => Pembayaran::where('status_pembayaran', 'lunas')->count(),

    'ditolak' => 0,

    'total' => Pembayaran::count(),
];

    return view('pages.verifikasi_admin', compact(
        'pembayaran',
        'statistik'
    ));
}}