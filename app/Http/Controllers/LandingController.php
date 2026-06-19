<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipeKamar;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        $selectedCategory = $request->query('category');
        $search = $request->query('search');

        // Hanya tampilkan tipe kamar yang punya kamar tersedia
        $query = TipeKamar::whereHas('kamar', function ($q) {
            $q->where('status_kamar', 'tersedia');
        });

        if ($selectedCategory) {
            $query->where('detail_kamar', 'like', '%' . $selectedCategory . '%');
        }

        if ($search) {
            $query->where('detail_kamar', 'like', '%' . $search . '%');
        }

        $tipeKamar = $query->get();

        return view('pages.landing', [
            'rooms' => $tipeKamar,
            'selectedCategory' => $selectedCategory,
            'search' => $search,
        ]);
    }
}
