<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Faktur;
use App\Models\Reservasi;

class ProfilTamuController extends Controller
{
    public function index()
    {
        if (!Auth::guard('tamu')->check()) {
            return redirect()->route('login.tamu');
        }

        $tamu = Auth::guard('tamu')->user();

        $user = (object) [
            'name'          => $tamu->name,
            'email'         => $tamu->email,
            'telepon'       => $tamu->phone ?? '-',
            'jenis_kelamin' => $tamu->jenis_kelamin ?? '-',
            'alamat'        => $tamu->alamat ?? '-',
        ];

        // Ambil semua faktur milik tamu ini lewat relasi reservasi
        $fakturs = Faktur::whereHas('reservasi', function ($q) use ($tamu) {
                $q->where('tamu_id', $tamu->id);
            })
            ->with('reservasi.tipe')
            ->latest('no_faktur')
            ->get();

        // Riwayat reservasi (semua status)
        $riwayat = Reservasi::with('tipe')
            ->where('tamu_id', $tamu->id)
            ->latest('id_reservasi')
            ->get();

        return view('pages.profile_tamu', compact('user', 'fakturs', 'riwayat'));
    }

    public function update(Request $request)
    {
        $tamu = Auth::guard('tamu')->user();

        $request->validate([
            'nama'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $tamu->update([
            'name'  => $request->nama,
            'email' => $request->email,
        ]);

        return redirect()->route('profil')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}