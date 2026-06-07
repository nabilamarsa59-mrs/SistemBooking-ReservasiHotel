<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\TipeKamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    public function index()
    {
        $kamar = Kamar::with('tipe')->paginate(10);
        $tipeKamar = TipeKamar::all();

        $total = Kamar::count();
        $tersedia = Kamar::where('status_kamar', 'tersedia')->count();
        $terisi = Kamar::where('status_kamar', 'terisi')->count();
        $perbaikan = Kamar::where('status_kamar', 'perbaikan')->count();

        return view('pages.data_kamar', compact(
            'kamar', 'tipeKamar', 'total', 'tersedia', 'terisi', 'perbaikan'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_tipe'      => 'required|exists:tipe_kamar,id_tipe',
            'no_kamar'     => 'required|string|max:20|unique:kamar,no_kamar',
            'status_kamar' => 'required|in:tersedia,terisi,perbaikan'
        ]);

        Kamar::create($request->only(['id_tipe', 'no_kamar', 'status_kamar']));

        return redirect()->route('kamar.index')
            ->with('success', 'Kamar berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $kamar = Kamar::findOrFail($id);

        $request->validate([
            'id_tipe'      => 'required|exists:tipe_kamar,id_tipe',
            'no_kamar'     => 'required|string|max:20|unique:kamar,no_kamar,' . $id,
            'status_kamar' => 'required|in:tersedia,terisi,perbaikan'
        ]);

        $kamar->update($request->only(['id_tipe', 'no_kamar', 'status_kamar']));

        return redirect()->route('kamar.index')
            ->with('success', 'Kamar berhasil diperbarui');
    }

    public function destroy($id)
    {
        Kamar::findOrFail($id)->delete();

        return redirect()->route('kamar.index')
            ->with('success', 'Kamar berhasil dihapus');
    }
}
