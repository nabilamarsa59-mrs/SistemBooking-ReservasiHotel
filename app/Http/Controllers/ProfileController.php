<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {

        $profile = [
            'nama' => 'Revan',
            'email' => 'resepsionis@gmail.com',
            'telepon' => '082344556677',
            'password' => '12345678',
            'gender' => 'Laki-laki',
            'alamat' => 'Batam',
            'role' => 'resepsionis', // admin / resepsionis
        ];

        return view('pages.profile', compact('profile'));
    }

    public function update(Request $request)
    {
        return redirect()->route('profile')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}