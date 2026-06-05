<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservasi;

class DashboardTamuController extends Controller
{
    public function index(Request $request)
    {
        $tamu = Auth::guard('tamu')->user();

        $search = $request->query('search');
        $selectedCategory = $request->query('category');

        // Ambil reservasi aktif milik tamu yang login
        $reservasiAktif = Reservasi::with(['tipeKamar', 'kamar'])
            ->where('tamu_id', $tamu->id)
            ->where('check_out', '>=', now()->toDateString())
            ->latest()
            ->first();

        $allRooms = [
            ['name' => 'Standar',      'slug' => 'standar',      'capacity' => '2 Tamu', 'bed' => '1 Ranjang', 'breakfast' => 'Tidak Termasuk Sarapan', 'price' => 250000],
            ['name' => 'Deluxe',       'slug' => 'deluxe',       'capacity' => '2 Tamu', 'bed' => '1 Ranjang', 'breakfast' => 'Termasuk Sarapan',        'price' => 1100000],
            ['name' => 'Suite',        'slug' => 'suite',        'capacity' => '2 Tamu', 'bed' => '1 Ranjang', 'breakfast' => 'Termasuk Sarapan',        'price' => 1550000],
            ['name' => 'Presidential', 'slug' => 'presidential', 'capacity' => '2 Tamu', 'bed' => '2 Ranjang', 'breakfast' => 'Termasuk Sarapan',        'price' => 1900000],
        ];

        $rooms = collect($allRooms);

        if ($selectedCategory) {
            $rooms = $rooms->filter(function ($room) use ($selectedCategory) {
                return strtolower($room['name']) == strtolower($selectedCategory);
            });
        }

        if ($search) {
            $rooms = $rooms->filter(function ($room) use ($search) {
                return str_contains(strtolower($room['name']), strtolower($search));
            });
        }

        return view('pages.dashboard_tamu', [
            'rooms'            => $rooms,
            'search'           => $search,
            'selectedCategory' => $selectedCategory,
            'reservasiAktif'   => $reservasiAktif,
            'tamu'             => $tamu,
        ]);
    }
}
