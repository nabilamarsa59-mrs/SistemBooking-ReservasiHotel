<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            TipeKamarSeeder::class,
            KamarSeeder::class,
            TamuSeeder::class,
            PenggunaSeeder::class,
            ReservasiSeeder::class,
            FakturSeeder::class,
            PembayaranSeeder::class,
        ]);
    }
}
