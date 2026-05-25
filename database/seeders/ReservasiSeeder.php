<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservasi;

class ReservasiSeeder extends Seeder
{
    public function run(): void
    {
        Reservasi::create([
            'tamu_id' => 1,
            'pengguna_id' => 1,
            'id_tipe' => 1,
            'check_in' => '2026-05-20',
            'check_out' => '2026-05-22'
        ]);
    }
}