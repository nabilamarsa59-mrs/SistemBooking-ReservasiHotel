<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\pengguna; 
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        pengguna::create([
            'nama'          => 'Admin',
            'email'         => 'admin@gmail.com',
            'password'      => Hash::make('admin123'),
            'alamat'        => 'Batam',
            'no_telepon'    => '08123456789',
            'jenis_kelamin' => 'P',
            'foto_pengguna' => 'admin.jpg',
            'role'          => 'admin'
        ]);

        // Resepsionis
        pengguna::create([
            'nama'          => 'Resepsionis',
            'email'         => 'resepsionis@gmail.com',
            'password'      => Hash::make('resepsionis123'),
            'alamat'        => 'Batam',
            'no_telepon'    => '08987654321',
            'jenis_kelamin' => 'P',
            'foto_pengguna' => 'resepsionis.jpg',
            'role'          => 'resepsionis'
        ]);
    }
}