<?php

namespace App\Http\Controllers;
use App\Models\MonthlyStat; // Harus panggil modelnya

class StatistikController extends Controller {
    public function tampilkanHalaman() {
        // Mengambil semua data dari database
        $stats = MonthlyStat::all(); 

        // Mengambil data bulan Mei secara spesifik (sesuai wireframe)
        $current = MonthlyStat::where('month', 'Mei')->first();

        // Mengambil data bulan April
        $previous = MonthlyStat::where('month', 'April')->first();

        // Mengirim variabel ke file statistik_admin.blade.php
        return view('statistik_admin', compact('stats', 'current', 'previous'));
    }
}

