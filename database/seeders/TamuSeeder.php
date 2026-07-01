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
            'nik'        => '21710001',
            'name'       => 'Nabila',
            'email'      => 'nabila@gmail.com',
            'password'   => Hash::make('nabila321'),
            'foto_tamu'  => 'nabila.jpg',
            'phone'      => '08123456789'
        ]);
    }
}