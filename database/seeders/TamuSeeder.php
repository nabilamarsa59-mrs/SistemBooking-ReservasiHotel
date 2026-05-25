<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tamu;
use Illuminate\Support\Facades\Hash;

class TamuSeeder extends Seeder
{
    public function run(): void
    {
        Tamu::create([
            'nik' => '21710001',
            'nama_tamu' => 'Nabila',
            'password' => Hash::make('password'),
            'foto_tamu' => 'nabila.jpg',
            'no_telepon' => '08123456789'
        ]);
    }
}