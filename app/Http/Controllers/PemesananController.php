<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservasi;
use App\Models\TipeKamar;
use App\Models\Kamar;
use App\Models\Faktur;
use Carbon\Carbon;

class PemesananController extends Controller
{
    public function showPemesanan(Request $request)
    {
        $tamu    = Auth::guard('tamu')->user();
        $kamarId = $request->query('kamar_id');

        $tipeKamar = TipeKamar::findOrFail($kamarId);

        $slug = strtolower($tipeKamar->detail_kamar);
        if (str_contains($slug, 'standard'))                                                $image = 'images/kamar/kamar_standard.jpeg';
        elseif (str_contains($slug, 'suite'))                                               $image = 'images/kamar/kamar_suite.jpeg';
        elseif (str_contains($slug, 'deluxe'))                                              $image = 'images/kamar/kamar_deluxe.jpeg';
        elseif (str_contains($slug, 'presidental') || str_contains($slug, 'presidential')) $image = 'images/kamar/kamar_presidential.jpeg';
        else                                                                                $image = 'images/hotel.png';

        $totalKamarTersedia = Kamar::where('id_tipe', $tipeKamar->id_tipe)
            ->where('status_kamar', 'tersedia')
            ->count();

        return view('pages.pemesanan', [
            'tamu'               => $tamu,
            'tipeKamar'          => $tipeKamar,
            'image'              => $image,
            'totalKamarTersedia' => $totalKamarTersedia,
        ]);
    }

    public function store(Request $request)
    {
        $tamu = Auth::guard('tamu')->user();

        $request->validate([
            'id_tipe'   => 'required|integer|exists:tipe_kamar,id_tipe',
            'check_in'  => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
        ]);

        $checkIn  = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);
        $idTipe   = $request->id_tipe;

        $tipeKamar = TipeKamar::findOrFail($idTipe);

        // Cek kamar tersedia
        $jumlahKamar = Kamar::where('id_tipe', $idTipe)
            ->where('status_kamar', 'tersedia')
            ->count();

        if ($jumlahKamar === 0) {
            return back()->withErrors(['check_in' => 'Tidak ada kamar tersedia untuk tipe ini.'])->withInput();
        }

        // Cek konflik tanggal
        $kamarDipesan = Reservasi::where('id_tipe', $idTipe)
            ->whereIn('status_reservasi', ['pending', 'aktif'])
            ->where(function ($q) use ($checkIn, $checkOut) {
                $q->where('check_in', '<', $checkOut)
                  ->where('check_out', '>', $checkIn);
            })
            ->count();

        if ($kamarDipesan >= $jumlahKamar) {
            return back()->withErrors([
                'check_in' => 'Kamar tidak tersedia pada tanggal ' .
                    $checkIn->translatedFormat('d M Y') . ' – ' .
                    $checkOut->translatedFormat('d M Y') . '. Silakan pilih tanggal lain.',
            ])->withInput();
        }

        // 1. Buat reservasi dengan status pending
        $reservasi = Reservasi::create([
            'tamu_id'          => $tamu->id,
            'pengguna_id'      => 1,
            'id_tipe'          => $idTipe,
            'check_in'         => $checkIn->toDateString(),
            'check_out'        => $checkOut->toDateString(),
            'status_reservasi' => 'pending',
        ]);

        // 2. Buat faktur otomatis
        $durasi = $checkIn->diffInDays($checkOut);

        Faktur::create([
            'id_reservasi'   => $reservasi->id_reservasi,
            'nama_tamu'      => $tamu->name,
            'tipe_kamar'     => $tipeKamar->detail_kamar,
            'durasi'         => $durasi,
            'total_tagihan'  => $durasi * $tipeKamar->harga_kamar,
            'tanggal_faktur' => now(),
        ]);

        return redirect()
            ->route('dashboard.tamu')
            ->with('success', 'Pemesanan berhasil! Menunggu konfirmasi dari admin.');
    }

    public function batalkan(Request $request, $id)
    {
        $tamu = Auth::guard('tamu')->user();

        $reservasi = Reservasi::where('id_reservasi', $id)
            ->where('tamu_id', $tamu->id)
            ->firstOrFail();

        // Hanya bisa batalkan kalau masih pending
        if ($reservasi->status_reservasi !== 'pending') {
            return redirect()
                ->route('dashboard.tamu')
                ->with('error', 'Pemesanan yang sudah aktif tidak bisa dibatalkan sendiri. Hubungi admin.');
        }

        $reservasi->update(['status_reservasi' => 'dibatalkan']);

        return redirect()
            ->route('dashboard.tamu')
            ->with('success', 'Pemesanan berhasil dibatalkan.');
    }
}