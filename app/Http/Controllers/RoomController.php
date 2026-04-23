<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        
        // Statistik sederhana
        $stats = [
            'total' => $rooms->count(),
            'available' => $rooms->where('status', 'Tersedia')->count(),
            'occupied' => $rooms->where('status', 'Terisi')->count(),
            'maintenance' => $rooms->where('status', 'Perbaikan')->count(),
        ];

        return view('pages.room', compact('rooms', 'stats'));
    }
}
