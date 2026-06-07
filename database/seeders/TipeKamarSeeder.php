<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipeKamar;

class TipeKamarSeeder extends Seeder
{
    public function run(): void
    {
        TipeKamar::insert([
            [
                'detail_kamar' => 'Standard',
                'harga_kamar'  => 480000,
                'fasilitas'    => 'AC, TV, WiFi, Kamar Mandi Dalam',
                'foto_kamar'   => 'standard.jpg',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'detail_kamar' => 'Deluxe',
                'harga_kamar'  => 520000,
                'fasilitas'    => 'AC, TV, WiFi, Kamar Mandi Dalam, Sarapan',
                'foto_kamar'   => 'deluxe.jpg',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'detail_kamar' => 'Suite',
                'harga_kamar'  => 750000,
                'fasilitas'    => 'AC, TV, WiFi, Kamar Mandi Dalam, Sarapan, Bathtub, Sofa',
                'foto_kamar'   => 'suite.jpg',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'detail_kamar' => 'Presidental',
                'harga_kamar'  => 920000,
                'fasilitas'    => 'AC, TV, WiFi, Kamar Mandi Dalam, Sarapan, Bathtub, Ruang Tamu, Minibar',
                'foto_kamar'   => 'presidental.jpg',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}
