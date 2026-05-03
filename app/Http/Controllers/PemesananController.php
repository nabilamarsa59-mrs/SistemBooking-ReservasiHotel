<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function showPemesanan(Request $request)
    {
        $type = $request->query('type', 'Standar');

        $roomDetails = [
            'Standar' => [
                'image' => 'images/kamar/kamar_standard.jpeg',
                'price' => 250000,
                'desc' => '1 Ranjang, Tidak termasuk sarapan'
            ],

            'Deluxe' => [
                'image' => 'images/kamar/kamar_deluxe.jpeg',
                'price' => 1100000,
                'desc' => '1 Queen Bed, Termasuk sarapan'
            ],

            'Suite' => [
                'image' => 'images/kamar/kamar_suite.jpeg',
                'price' => 1550000,
                'desc' => '1 King Bed, Termasuk sarapan'
            ],

            'Presidential' => [
                'image' => 'images/kamar/kamar_presidential.jpeg',
                'price' => 19000000,
                'desc' => '2 King Bed, Termasuk sarapan'
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
}