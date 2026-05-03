<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room; 

class DashboardTamuController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $selectedCategory = $request->query('category');

        $allRooms = [
            ['name' => 'Standar', 'capacity' => '2 Tamu', 'bed' => '1 Ranjang', 'breakfast' => 'Tidak Termasuk Sarapan', 'price' => 250000],
            ['name' => 'Deluxe', 'capacity' => '2 Tamu', 'bed' => '1 Ranjang', 'breakfast' => 'Termasuk Sarapan', 'price' => 1100000],
            ['name' => 'Suite', 'capacity' => '2 Tamu', 'bed' => '1 Ranjang', 'breakfast' => 'Termasuk Sarapan', 'price' => 1550000],
            ['name' => 'Presidential', 'capacity' => '2 Tamu', 'bed' => '2 Ranjang', 'breakfast' => 'Termasuk Sarapan', 'price' => 1900000],
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
            'rooms' => $rooms,
            'search' => $search,
            'selectedCategory' => $selectedCategory
        ]);
    }

}