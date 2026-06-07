<?php

namespace App\Http\Controllers;

use App\Models\TipeKamar;
use Illuminate\Http\Request;

class TipeKamarController extends Controller
{
    public function index()
    {
        $tipeKamar = TipeKamar::withCount('kamar')->paginate(10);
        return view('pages.data_tipe_kamar', compact('tipeKamar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'detail_kamar' => 'required|string',
            'harga_kamar'  => 'required|numeric|min:0',
            'fasilitas'    => 'required|string',
            'foto_kamar'   => 'nullable|image|max:2048'
        ]);

        $data = $request->only(['detail_kamar', 'harga_kamar', 'fasilitas']);

        if ($request->hasFile('foto_kamar')) {
            $data['foto_kamar'] = $request->file('foto_kamar')
                ->store('foto_kamar', 'public');
        }

        TipeKamar::create($data);

        return redirect()->route('tipe-kamar.index')
            ->with('success', 'Tipe kamar berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $tipe = TipeKamar::findOrFail($id);

        $request->validate([
            'detail_kamar' => 'required|string',
            'harga_kamar'  => 'required|numeric|min:0',
            'fasilitas'    => 'required|string',
            'foto_kamar'   => 'nullable|image|max:2048'
        ]);

        $data = $request->only(['detail_kamar', 'harga_kamar', 'fasilitas']);

        if ($request->hasFile('foto_kamar')) {
            $data['foto_kamar'] = $request->file('foto_kamar')
                ->store('foto_kamar', 'public');
        }

        $tipe->update($data);

        return redirect()->route('tipe-kamar.index')
            ->with('success', 'Tipe kamar berhasil diperbarui');
    }

    public function destroy($id)
    {
        TipeKamar::findOrFail($id)->delete();

        return redirect()->route('tipe-kamar.index')
            ->with('success', 'Tipe kamar berhasil dihapus');
    }
}
