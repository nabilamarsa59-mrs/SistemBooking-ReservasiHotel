<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservasiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reservasi')->insert([
            [
                'tamu_id' => 1,
                'pengguna_id' => 1,
                'id_tipe' => 1,
                'check_in' => '2026-05-10',
                'check_out' => '2026-05-11',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tamu_id' => 2,
                'pengguna_id' => 1,
                'id_tipe' => 2,
                'check_in' => '2026-05-11',
                'check_out' => '2026-05-13',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tamu_id' => 3,
                'pengguna_id' => 1,
                'id_tipe' => 1,
                'check_in' => '2026-05-12',
                'check_out' => '2026-05-13',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}