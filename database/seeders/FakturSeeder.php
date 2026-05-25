<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faktur;

class FakturSeeder extends Seeder
{
    public function run(): void
    {
        Faktur::create([
            'id_reservasi' => 1,
            'nama_tamu' => 'Nabila',
            'tipe_kamar' => 'Deluxe',
            'durasi' => 2,
            'total_tagihan' => 1000000,
            'tanggal_faktur' => now()
        ]);
    }
}