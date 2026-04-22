<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        $rooms = [
            [
                'name' => 'Standar',
                'slug' => 'standar',
                'capacity' => '2 Dewasa',
                'bed' => '1 Ranjang',
                'breakfast' => 'Tidak termasuk sarapan',
                'price' => 250000,
            ],
            [
                'name' => 'Suite',
                'slug' => 'suite',
                'capacity' => '2 Dewasa',
                'bed' => '1 Ranjang',
                'breakfast' => 'Termasuk sarapan',
                'price' => 1500000,
            ],
            [
                'name' => 'Deluxe',
                'slug' => 'deluxe',
                'capacity' => '2 Dewasa',
                'bed' => '1 Ranjang',
                'breakfast' => 'Termasuk sarapan',
                'price' => 1100000,
            ],
            [
                'name' => 'Presidential',
                'slug' => 'presidential',
                'capacity' => '2 Dewasa',
                'bed' => '1 Ranjang',
                'breakfast' => 'Termasuk sarapan',
                'price' => 1900000,
            ],
        ];

        $selectedCategory = $request->query('category');
        $search = $request->query('search');

        if ($selectedCategory) {
            $rooms = array_filter($rooms, function ($room) use ($selectedCategory) {
                return $room['slug'] === $selectedCategory;
            });
        }

        if ($search) {
            $rooms = array_filter($rooms, function ($room) use ($search) {
                return str_contains(strtolower($room['name']), strtolower($search));
            });
        }

        return view('pages.landing', [
            'rooms' => $rooms,
            'selectedCategory' => $selectedCategory,
            'search' => $search,
        ]);
    }
}