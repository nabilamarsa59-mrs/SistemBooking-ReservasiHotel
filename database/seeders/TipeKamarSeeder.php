<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipeKamar;

class TipeKamarSeeder extends Seeder
{
    public function run(): void
    {
        TipeKamar::create([
            'detail_kamar' => 'Kamar Deluxe',
            'harga_kamar' => 500000,
            'fasilitas' => 'AC, TV, WiFi',
            'foto_kamar' => 'deluxe.jpg'
        ]);

        TipeKamar::create([
            'detail_kamar' => 'Kamar Standard',
            'harga_kamar' => 300000,
            'fasilitas' => 'AC, TV',
            'foto_kamar' => 'standard.jpg'
        ]);
    }
}