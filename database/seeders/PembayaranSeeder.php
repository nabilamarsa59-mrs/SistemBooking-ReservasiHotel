<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembayaran;

class PembayaranSeeder extends Seeder
{
    public function run(): void
    {
        Pembayaran::create([
            'no_faktur' => 1,
            'tanggal_pembayaran' => now(),
            'metode_pembayaran' => 'Transfer Bank',
            'jumlah_bayar' => 1000000,
            'status_pembayaran' => 'lunas',
            'bukti_pembayaran' => 'bukti.jpg'
        ]);
    }
}