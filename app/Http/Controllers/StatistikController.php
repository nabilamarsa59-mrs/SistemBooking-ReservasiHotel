<?php

namespace App\Http\Controllers;

use App\Models\MonthlyStat;

class StatistikController extends Controller
{
    public function tampilkanHalaman()
    {
        $statistics = MonthlyStat::orderBy('id')->get();

        $labels = $statistics->pluck('month');
        $revenues = $statistics->pluck('revenue');
        $visitors = $statistics->pluck('visitors');

        $bulanIni = $statistics->last();

        $bulanLalu = $statistics->count() >= 2
            ? $statistics[$statistics->count() - 2]
            : null;

        return view('pages.statistik_admin', compact(
            'labels',
            'revenues',
            'visitors',
            'bulanIni',
            'bulanLalu'
        ));
    }
}