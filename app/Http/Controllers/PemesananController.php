<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PemesananController extends Controller

{
public function showPemesanan(Request $request) {
    $type = $request->query('type', 'Standar'); // Ambil tipe dari URL, default Standar

    // Data detail tiap kamar (samakan dengan dashboard)
    $roomDetails = [
        'Standar' => ['image' => 'images/kamar/kamar_standard.jpeg', 'price' => 250000, 'desc' => '1 Ranjang, Tidak termasuk sarapan'],
        'Deluxe' => ['image' => 'images/kamar/kamar_deluxe.jpeg', 'price' => 550000, 'desc' => '1 Queen Bed, Termasuk sarapan'],
        'Suite' => ['image' => 'images/kamar/kamar_suite.jpeg', 'price' => 850000, 'desc' => '1 King Bed, Termasuk sarapan'],
        'Presidential' => ['image' => 'images/kamar/kamar_presidential.jpeg', 'price' => 1500000, 'desc' => '2 King Bed, Termasuk sarapan'],
    ];

    $selectedRoom = $roomDetails[$type] ?? $roomDetails['Standar'];

    return view('pages.pemesanan', compact('selectedRoom', 'type'));
}
}