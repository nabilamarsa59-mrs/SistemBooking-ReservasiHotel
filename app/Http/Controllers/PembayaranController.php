<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::with('reservasi.tamu')->latest()->get();
        return view('pages.data_pembayaran', compact('pembayaran'));
    }

    public function create()
    {
        return view('pages.pembayaran');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_reservasi'   => 'required|exists:reservasi,id_reservasi',
            'bukti_transfer' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Hitung total bayar dari data reservasi & kamar
        $reservasi   = Reservasi::with('kamar')->findOrFail($request->id_reservasi);
        $durasi      = $reservasi->tanggal_checkin->diffInDays($reservasi->tanggal_checkout);
        $totalBayar  = $reservasi->kamar->harga * $durasi;

        // Cari atau buat record pembayaran
        $pembayaran = Pembayaran::firstOrCreate(
            ['id_reservasi' => $request->id_reservasi],
            [
                'total_bayar'       => $totalBayar,
                'status_verifikasi' => false,
            ]
        );

        // Upload file bukti transfer ke storage
        $path = $request->file('bukti_transfer')->store('bukti_transfer', 'public');

        // Panggil uploadBukti() dari model - sesuai class diagram
        $pembayaran->uploadBukti($path);

        return redirect()->back()->with('success', 'Bukti transfer berhasil diupload!');
    }

    public function show(Pembayaran $pembayaran)
    {
        $pembayaran->load('reservasi.tamu', 'reservasi.kamar.tipeKamar');
        return view('pages.detail_pembayaran', compact('pembayaran'));
    }

    public function edit(Pembayaran $pembayaran)
    {
        return view('pages.edit_pembayaran', compact('pembayaran'));
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'bukti_transfer' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Hapus file lama jika ada
        if ($pembayaran->bukti_transfer) {
            Storage::disk('public')->delete($pembayaran->bukti_transfer);
        }

        $path = $request->file('bukti_transfer')->store('bukti_transfer', 'public');

        // Panggil uploadBukti() dari model
        $pembayaran->uploadBukti($path);

        return redirect()->back()->with('success', 'Bukti transfer berhasil diperbarui!');
    }

    public function destroy(Pembayaran $pembayaran)
    {
        if ($pembayaran->bukti_transfer) {
            Storage::disk('public')->delete($pembayaran->bukti_transfer);
        }
        $pembayaran->delete();

        return redirect()->back()->with('success', 'Data pembayaran dihapus.');
    }

    public function verifikasi(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'diterima' => 'required|boolean',
        ]);

        // Panggil verifikasiPembayaran() dari model - sesuai class diagram
        $pembayaran->verifikasiPembayaran((bool) $request->diterima);

        $pesan = $request->diterima
            ? 'Pembayaran berhasil diverifikasi!'
            : 'Pembayaran ditolak, tamu perlu upload ulang.';

        return redirect()->back()->with('success', $pesan);
    }
}