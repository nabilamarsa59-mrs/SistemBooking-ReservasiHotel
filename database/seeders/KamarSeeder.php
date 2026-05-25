<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kamar;

class KamarSeeder extends Seeder
{
    public function run(): void
    {
        Kamar::create([
            'id_tipe' => 1,
            'no_kamar' => '101',
            'status_kamar' => 'tersedia'
        ]);

        Kamar::create([
            'id_tipe' => 2,
            'no_kamar' => '102',
            'status_kamar' => 'terisi'
        ]);
    }
}