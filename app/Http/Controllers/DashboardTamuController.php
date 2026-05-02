<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room; // <-- PASTIKAN BARIS INI ADA

class DashboardTamuController extends Controller
{
       public function index(Request $request)
{
    $search = $request->query('search');
    $selectedCategory = $request->query('category');

    // DATA DUMMY
    $allRooms = [
        ['name' => 'Standar', 'capacity' => '2 Tamu', 'bed' => '1 Single Bed', 'breakfast' => 'Tanpa Sarapan', 'price' => 350000],
        ['name' => 'Deluxe', 'capacity' => '2 Tamu', 'bed' => '1 Queen Bed', 'breakfast' => 'Gratis Sarapan', 'price' => 550000],
        ['name' => 'Suite', 'capacity' => '3 Tamu', 'bed' => '1 King Bed', 'breakfast' => 'Gratis Sarapan', 'price' => 850000],
        ['name' => 'Presidential', 'capacity' => '4 Tamu', 'bed' => '2 King Bed', 'breakfast' => 'Gratis Sarapan', 'price' => 1500000],
    ];

    // Filter Logic
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
        'rooms' => $rooms,
        'search' => $search,
        'selectedCategory' => $selectedCategory
    ]);
}

}