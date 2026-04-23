<?php

namespace App\Http\Controllers;
use App\Models\MonthlyStat; // Harus panggil modelnya

class StatistikController extends Controller {
    public function tampilkanHalaman() {

        // Mengirim variabel ke file statistik_admin.blade.php
        return view('pages.statistik_admin');
    }
}

