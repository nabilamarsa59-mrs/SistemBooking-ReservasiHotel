<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Room::create(['number' => '101', 'type' => 'Deluxe', 'price' => 500000, 'status' => 'Tersedia']);
        \App\Models\Room::create(['number' => '102', 'type' => 'Standard', 'price' => 300000, 'status' => 'Terisi']);

    }
}
