<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    public function index()
    {
        $statistik = [
            'menunggu' => 12,
            'terverifikasi' => 28,
        ];

        $pembayaran = [
            [
                'id' => '#RSV-013',
                'nama' => 'Revan',
                'metode' => 'Transfer BCA',
                'jumlah' => 'Rp.500.000',
                'tanggal' => '10/05/2026',
                'status' => 'menunggu',
            ],
            [
                'id' => '#RSV-014',
                'nama' => 'Nabila Marsa',
                'metode' => 'Transfer Mandiri',
                'jumlah' => 'Rp.3.900.000',
                'tanggal' => '11/05/2026',
                'status' => 'menunggu',
            ],
        ];

        return view('pages.verifikasi_admin', compact('statistik', 'pembayaran'));
    }
}