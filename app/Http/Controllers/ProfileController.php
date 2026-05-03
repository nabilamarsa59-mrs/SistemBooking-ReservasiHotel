<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {

        $profile = [
            'nama' => 'Nabila Marsa',
            'email' => 'nabilamarsa@gmail.com',
            'telepon' => '082344556677',
            'password' => '12345678',
            'gender' => 'Perempuan',
            'alamat' => 'Bengkong Kodim',
            'role' => 'admin', // admin / resepsionis
        ];

        return view('pages.profile', compact('profile'));
    }

    public function update(Request $request)
    {
        return redirect()->route('profile')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}