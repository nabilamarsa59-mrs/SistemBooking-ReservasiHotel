<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservasi;

class PemesananController extends Controller
{
    public function showPemesanan(Request $request)
    {
        $type = $request->query('type', 'Standar');

        $roomDetails = [
            'Standar' => [
                'image' => 'images/kamar/kamar_standard.jpeg',
                'price' => 250000,
                'desc'  => '1 Ranjang, Tidak termasuk sarapan',
            ],
            'Deluxe' => [
                'image' => 'images/kamar/kamar_deluxe.jpeg',
                'price' => 1100000,
                'desc'  => '1 Queen Bed, Termasuk sarapan',
            ],
            'Suite' => [
                'image' => 'images/kamar/kamar_suite.jpeg',
                'price' => 1550000,
                'desc'  => '1 King Bed, Termasuk sarapan',
            ],
            'Presidential' => [
                'image' => 'images/kamar/kamar_presidential.jpeg',
                'price' => 19000000,
                'desc'  => '2 King Bed, Termasuk sarapan',
            ],
        ];

        $selectedRoom = $roomDetails[$type] ?? $roomDetails['Standar'];

        return view('pages.pemesanan', compact('selectedRoom', 'type'));
    }

    public function store(Request $request)
    {
        return redirect()
            ->route('dashboard.tamu')
            ->with('success', 'Pemesanan berhasil dilakukan!');
    }

    // Batalkan pemesanan
    public function batalkan(Request $request, $id)
    {
        $tamu = Auth::guard('tamu')->user();

        $reservasi = Reservasi::where('id_reservasi', $id)
            ->where('tamu_id', $tamu->id)
            ->firstOrFail();

        $reservasi->delete();

        return redirect()
            ->route('dashboard.tamu')
            ->with('success', 'Pemesanan berhasil dibatalkan.');
    }

    // Cek ketersediaan kamar berdasarkan tanggal
    public function cekKetersediaan(Request $request)
    {
        $request->validate([
            'check_in'  => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
        ]);

        $checkIn  = $request->check_in;
        $checkOut = $request->check_out;

        // Cari reservasi yang bentrok dengan tanggal yang dipilih
        $reserved = Reservasi::where(function ($q) use ($checkIn, $checkOut) {
            $q->where('check_in', '<', $checkOut)
              ->where('check_out', '>', $checkIn);
        })->pluck('id_tipe')->toArray();

        return response()->json([
            'reserved' => $reserved,
            'check_in' => $checkIn,
            'check_out' => $checkOut,
        ]);
    }
}
