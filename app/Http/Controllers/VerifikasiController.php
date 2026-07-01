<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;

class VerifikasiController extends Controller
{

    public function index()
    {
        $reservasiList = Reservasi::with(['tamu', 'tipe', 'faktur'])
            ->orderByRaw("FIELD(status_reservasi, 'pending', 'aktif', 'dibatalkan')")
            ->latest('id_reservasi')
            ->get();

        $statistik = [
            'menunggu'   => $reservasiList->where('status_reservasi', 'pending')->count(),
            'aktif'      => $reservasiList->where('status_reservasi', 'aktif')->count(),
            'dibatalkan' => $reservasiList->where('status_reservasi', 'dibatalkan')->count(),
            'total'      => $reservasiList->count(),
        ];

        return view('pages.verifikasi_admin', compact('reservasiList', 'statistik'));
    }

    public function approve(Request $request, $id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->update(['status_reservasi' => 'aktif']);

        return redirect()
            ->route('verifikasi.admin')
            ->with('success', 'Pemesanan #RSV-' . str_pad($id, 3, '0', STR_PAD_LEFT) . ' berhasil dikonfirmasi.');
    }

    public function tolak(Request $request, $id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->update(['status_reservasi' => 'dibatalkan']);

        return redirect()
            ->route('verifikasi.admin')
            ->with('success', 'Pemesanan #RSV-' . str_pad($id, 3, '0', STR_PAD_LEFT) . ' telah ditolak.');
    }
}