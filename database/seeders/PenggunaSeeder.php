<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    public function run(): void
    {
        Pengguna::create([
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'alamat' => 'Batam',
            'no_telepon' => '08123456789',
            'jenis_kelamin' => 'P',
            'foto_pengguna' => 'admin.jpg',
            'role' => 'admin'
        ]);
    }
}