<?php

namespace App\Http\Controllers;

use App\Models\TipeKamar;
use Illuminate\Http\Request;

class TipeKamarController extends Controller
{
    public function index()
    {
        return TipeKamar::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'detail_kamar' => 'required',
            'harga_kamar' => 'required|numeric',
            'fasilitas' => 'required',
            'foto_kamar' => 'nullable|string'
        ]);

        return TipeKamar::create($request->all());
    }

    public function show($id)
    {
        return TipeKamar::with('kamar')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $tipe = TipeKamar::findOrFail($id);

        $tipe->update($request->all());

        return $tipe;
    }

    public function destroy($id)
    {
        TipeKamar::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus'
        ]);
    }
}