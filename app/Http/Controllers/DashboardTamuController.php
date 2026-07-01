<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TipeKamar;
use App\Models\Reservasi;

class DashboardTamuController extends Controller
{
    public function index(Request $request)
    {
        $tamu = Auth::guard('tamu')->user();

        $selectedCategory = $request->query('category');

        $reservasiAktif = Reservasi::with(['tipe', 'faktur'])
            ->where('tamu_id', $tamu->id)
            ->where('check_out', '>=', now()->toDateString())
            ->whereIn('status_reservasi', ['pending', 'aktif']) // ← TAMBAHAN: exclude 'dibatalkan'
            ->latest('id_reservasi')
            ->first();

        $query = TipeKamar::whereHas('kamar', function ($q) {
            $q->where('status_kamar', 'tersedia');
        });

        if ($selectedCategory) {
            $query->where('detail_kamar', 'like', '%' . $selectedCategory . '%');
        }

        $rooms = $query->get();

        $tipeList = TipeKamar::whereHas('kamar', function ($q) {
            $q->where('status_kamar', 'tersedia');
        })->get();

        return view('pages.dashboard_tamu', [
            'rooms'            => $rooms,
            'tipeList'         => $tipeList,
            'selectedCategory' => $selectedCategory,
            'reservasiAktif'   => $reservasiAktif,
            'tamu'             => $tamu,
        ]);
    }
}