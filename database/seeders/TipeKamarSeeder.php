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
                'detail_kamar' => 'Kamar Deluxe',
                'harga_kamar' => 350000,
                'fasilitas' => 'AC, TV, Wifi',
                'foto_kamar' => 'deluxe.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'detail_kamar' => 'Kamar Superior',
                'harga_kamar' => 500000,
                'fasilitas' => 'AC, TV, Wifi, Breakfast',
                'foto_kamar' => 'superior.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'detail_kamar' => 'Kamar Suite',
                'harga_kamar' => 850000,
                'fasilitas' => 'AC, TV, Wifi, Breakfast, Bathtub',
                'foto_kamar' => 'suite.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}