<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Faktur;
use App\Models\TipeKamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservasiController extends Controller
{
    public function index()
    {
        $data = Reservasi::with('tipe', 'tamu')->latest('id_reservasi')->get();

        $reservasis = $data->map(function ($r) {
            $ci     = $r->check_in;
            $co     = $r->check_out;
            $durasi = $ci && $co ? $ci->diffInDays($co) : 0;
            $harga  = $r->tipe->harga_kamar ?? 0;
            $total  = $durasi * $harga;

            return [
                'id'            => '#RSV-' . str_pad($r->id_reservasi, 3, '0', STR_PAD_LEFT),
                'nama_tamu'     => $r->tamu->name ?? '-',
                'email'         => $r->tamu->email ?? '-',
                'telepon'       => $r->tamu->phone ?? '-',
                'kamar'         => $r->tipe->detail_kamar ?? '-',
                'checkin'       => $ci ? $ci->translatedFormat('d M Y') : '-',
                'checkout'      => $co ? $co->translatedFormat('d M Y') : '-',
                'tgl_reservasi' => $r->created_at ? $r->created_at->translatedFormat('d M Y') : '-',
                'durasi'        => $durasi . ' malam',
                'total'         => 'Rp ' . number_format($total, 0, ',', '.'),
                'status'        => $r->status_reservasi ?? 'pending',
            ];
        });

        $totalPemesanan = $reservasis->count();
        $menunggu       = $reservasis->where('status', 'pending')->count();
        $dikonfirmasi   = $reservasis->where('status', 'aktif')->count();
        $dibatalkan     = $reservasis->where('status', 'dibatalkan')->count();

        return view('pages.data_reservasi', compact(
            'reservasis',
            'totalPemesanan',
            'menunggu',
            'dikonfirmasi',
            'dibatalkan'
        ));
    }

    // Tamu memesan kamar dari dashboard
    public function storeTamu(Request $request)
    {
        $request->validate([
            'id_tipe'   => 'required|integer',
            'check_in'  => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
        ]);

        $tamu = Auth::guard('tamu')->user();

        // Simpan reservasi dengan status pending
        $reservasi = Reservasi::create([
            'tamu_id'          => $tamu->id,
            'pengguna_id'      => 1, // default admin/resepsionis
            'id_tipe'          => $request->id_tipe,
            'check_in'         => $request->check_in,
            'check_out'        => $request->check_out,
            'status_reservasi' => 'pending', // ← selalu mulai dari pending
        ]);

        // Buat faktur otomatis setelah reservasi
        $tipe   = TipeKamar::findOrFail($request->id_tipe);
        $durasi = \Carbon\Carbon::parse($request->check_in)
                    ->diffInDays(\Carbon\Carbon::parse($request->check_out));

        Faktur::create([
            'id_reservasi'  => $reservasi->id_reservasi,
            'nama_tamu'     => $tamu->name,
            'tipe_kamar'    => $tipe->detail_kamar,
            'durasi'        => $durasi,
            'total_tagihan' => $durasi * $tipe->harga_kamar,
            'tanggal_faktur'=> now(),
        ]);

        return redirect()
            ->route('dashboard.tamu')
            ->with('success', 'Pemesanan berhasil! Silakan selesaikan pembayaran.');
    }

    // Admin mengkonfirmasi reservasi menjadi aktif
    public function konfirmasi($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->update(['status_reservasi' => 'aktif']);

        return redirect()
            ->route('data.reservasi')
            ->with('success', 'Reservasi berhasil dikonfirmasi.');
    }

    // Admin membatalkan reservasi
    public function tolak($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->update(['status_reservasi' => 'dibatalkan']);

        return redirect()
            ->route('data.reservasi')
            ->with('success', 'Reservasi berhasil dibatalkan.');
    }

    // Tamu membatalkan dari dashboard
    public function batal($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->update(['status_reservasi' => 'dibatalkan']);

        return redirect()
            ->route('dashboard.tamu')
            ->with('success', 'Pemesanan berhasil dibatalkan.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tamu_id'     => 'required|integer',
            'pengguna_id' => 'required|integer',
            'id_tipe'     => 'required|integer',
            'check_in'    => 'required|date',
            'check_out'   => 'required|date|after:check_in',
        ]);

        $validated['status_reservasi'] = 'pending';

        Reservasi::create($validated);

        return redirect()
            ->route('data.reservasi')
            ->with('success', 'Reservasi berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $reservasi = Reservasi::findOrFail($id);

        $validated = $request->validate([
            'tamu_id'     => 'required|integer',
            'pengguna_id' => 'required|integer',
            'id_tipe'     => 'required|integer',
            'check_in'    => 'required|date',
            'check_out'   => 'required|date|after:check_in',
        ]);

        $reservasi->update($validated);

        return redirect()
            ->route('data.reservasi')
            ->with('success', 'Reservasi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->delete();

        return redirect()
            ->route('data.reservasi')
            ->with('success', 'Reservasi berhasil dihapus');
    }
}