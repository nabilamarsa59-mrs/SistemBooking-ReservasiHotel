<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilTamuController extends Controller
{
    public function index()
    {
        if (session('role') !== 'tamu') {
            return redirect()->route('login.tamu');
        }

        $user = (object) [
            'name' => session('nama') ?? 'Edo Christian',
            'email' => session('email') ?? 'edochristian@gmail.com',
            'telepon' => '0823009810',
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Batam',
        ];

        $riwayat = [];
        $invoices = [];

        return view('pages.profile_tamu', compact('user', 'riwayat', 'invoices'));
    }

    public function update(Request $request)
    {
        session([
            'nama' => $request->nama,
            'email' => $request->email,
        ]);

        return redirect()->route('profil')
            ->with('success', 'Profil berhasil diperbarui.');
    }

    public function showInvoice($id)
    {
        return view('pages.invoice_detail', [
            'invoice' => null
        ]);
    }
}