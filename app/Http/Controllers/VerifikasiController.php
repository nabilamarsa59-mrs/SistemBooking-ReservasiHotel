<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    public function index()
    {
        $statistik = [
            'menunggu' => 3,
            'terverifikasi' => 1,
            'ditolak' => 1,
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
                'nama' => 'Nabila',
                'metode' => 'Transfer Mandiri',
                'jumlah' => 'Rp.3.900.000',
                'tanggal' => '11/05/2026',
                'status' => 'menunggu',
            ],
            [
                'id' => '#RSV-015',
                'nama' => 'Kurniawan',
                'metode' => 'Transfer BNI',
                'jumlah' => 'Rp.750.000',
                'tanggal' => '12/05/2026',
                'status' => 'menunggu',
            ],
            [
                'id' => '#RSV-016',
                'nama' => 'Eka',
                'metode' => 'Transfer BRI',
                'jumlah' => 'Rp.1.200.000',
                'tanggal' => '13/05/2026',
                'status' => 'terverifikasi',
            ],
            [
                'id' => '#RSV-017',
                'nama' => 'Marsa',
                'metode' => 'Transfer BCA',
                'jumlah' => 'Rp.900.000',
                'tanggal' => '14/05/2026',
                'status' => 'ditolak',
            ],
        ];

        return view('pages.verifikasi_admin', compact('statistik', 'pembayaran'));
    }
}