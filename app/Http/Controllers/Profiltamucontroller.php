<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class ProfilTamuController extends Controller
{
    public function index()
    {

        if (!Auth::guard('tamu')->check()) {
            return redirect()->route('login.tamu');
        }

        $tamu = Auth::guard('tamu')->user();

        $user = (object) [
            'name' => $tamu->name,
            'email' => $tamu->email,
            'telepon' => $tamu->phone ?? '0823009810',
            'jenis_kelamin' => $tamu->jenis_kelamin ?? 'Laki-laki',
            'alamat' => $tamu->alamat ?? 'Batam',
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