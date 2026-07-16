<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profil admin / resepsionis.
     */
    public function index()
    {
        $user = Auth::user();

        return view('pages.profile', compact('user'));
    }

    /**
     * Update profil — hanya nama dan jenis_kelamin yang boleh diubah.
     * Field lain (email, no_telepon, alamat, foto, password) tidak bisa diedit dari sini.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'nama'          => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', 'in:L,P'],
        ]);

        $user->update($validated);

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
