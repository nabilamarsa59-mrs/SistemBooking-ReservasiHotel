<?php

namespace App\Http\Controllers;
use App\Models\MonthlyStat;

class StatistikController extends Controller {
    public function tampilkanHalaman() {

        // Mengirim variabel ke file statistik_admin.blade.php
        return view('pages.statistik_admin');
    }
}

