<?php

namespace App\Http\Controllers;

use App\Models\Faktur;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class FakturController extends Controller
{

    public function show($id_reservasi)
    {
        $faktur = Faktur::where('id_reservasi', $id_reservasi)->firstOrFail();

        $dataFaktur = $faktur->cetakFaktur();

        return view('pages.faktur', compact('dataFaktur', 'faktur'));
    }

    public function cetak($id_reservasi)
    {
        $faktur = Faktur::where('id_reservasi', $id_reservasi)->firstOrFail();

        $dataFaktur = $faktur->cetakFaktur();

        return view('pages.faktur_cetak', compact('dataFaktur', 'faktur'));
    }
}