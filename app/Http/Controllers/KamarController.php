<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    public function index()
    {
        $kamar = Kamar::with('tipe')->get();

        return response()->json([
            'success' => true,
            'data' => $kamar
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_tipe' => 'required|integer',
            'no_kamar' => 'required|string|max:20|unique:kamar,no_kamar',
            'status_kamar' => 'required|string'
        ]);

        $kamar = Kamar::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data kamar berhasil ditambahkan',
            'data' => $kamar
        ], 201);
    }

    public function show($id)
    {
        $kamar = Kamar::with('tipe')->findOrFail($id);

        return response()->json($kamar);
    }

    public function update(Request $request, $id)
    {
        $kamar = Kamar::findOrFail($id);

        $request->validate([
            'id_tipe' => 'required|integer',
            'no_kamar' => 'required|string|max:20|unique:kamar,no_kamar,' . $id,
            'status_kamar' => 'required|string'
        ]);

        $kamar->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data kamar berhasil diperbarui',
            'data' => $kamar
        ]);
    }

    public function destroy($id)
    {
        $kamar = Kamar::findOrFail($id);
        $kamar->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data kamar berhasil dihapus'
        ]);
    }
}