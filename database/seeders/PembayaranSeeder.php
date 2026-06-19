<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembayaranSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pembayaran')->insert([
            [
                'no_faktur' => 1001,
                'tanggal_pembayaran' => now(),
                'metode_pembayaran' => 'Transfer BCA',
                'jumlah_bayar' => 500000,
                'status_pembayaran' => 'pending',
                'bukti_pembayaran' => null,
            ]
        ]);
    }
}