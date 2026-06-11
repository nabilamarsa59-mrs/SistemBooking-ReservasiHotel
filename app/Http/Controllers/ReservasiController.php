<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    public function index()
    {
        $reservasi = Reservasi::all();

        return view('reservasi.index', compact('reservasi'));
    }

    public function create()
    {
        return view('reservasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tamu_id' => 'required|integer',
            'pengguna_id' => 'required|integer',
            'id_tipe' => 'required|integer',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        Reservasi::create($validated);

        return redirect()
            ->route('reservasi.index')
            ->with('success', 'Reservasi berhasil ditambahkan');
    }

    public function show($id)
    {
        $reservasi = Reservasi::findOrFail($id);

        return view('reservasi.show', compact('reservasi'));
    }

    public function edit($id)
    {
        $reservasi = Reservasi::findOrFail($id);

        return view('reservasi.edit', compact('reservasi'));
    }

    public function update(Request $request, $id)
    {
        $reservasi = Reservasi::findOrFail($id);

        $validated = $request->validate([
            'tamu_id' => 'required|integer',
            'pengguna_id' => 'required|integer',
            'id_tipe' => 'required|integer',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        $reservasi->update($validated);

        return redirect()
            ->route('reservasi.index')
            ->with('success', 'Reservasi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $reservasi = Reservasi::findOrFail($id);

        $reservasi->delete();

        return redirect()
            ->route('reservasi.index')
            ->with('success', 'Reservasi berhasil dihapus');
    }
}