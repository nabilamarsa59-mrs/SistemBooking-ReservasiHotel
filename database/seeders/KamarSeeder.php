<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kamar;

class KamarSeeder extends Seeder
{
    public function run(): void
    {
        Kamar::insert([
            [
                'id_tipe' => 1,
                'no_kamar' => '101',
                'status_kamar' => 'tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_tipe' => 1,
                'no_kamar' => '102',
                'status_kamar' => 'terisi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_tipe' => 2,
                'no_kamar' => '201',
                'status_kamar' => 'tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_tipe' => 3,
                'no_kamar' => '301',
                'status_kamar' => 'maintenance',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}