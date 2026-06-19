<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    public function index()
    {
        $data = Reservasi::with('tipe', 'tamu')->latest('id_reservasi')->get();

        // Format data sesuai yang dibutuhkan view (array dengan key yang sama)
        $reservasis = $data->map(function ($r) {
            $ci     = $r->check_in;
            $co     = $r->check_out;
            $durasi = $ci && $co ? $ci->diffInDays($co) : 0;
            $harga  = $r->tipe->harga_kamar ?? 0;
            $total  = $durasi * $harga;

            return [
                'id'           => '#RSV-' . str_pad($r->id_reservasi, 3, '0', STR_PAD_LEFT),
                'nama_tamu'    => $r->tamu->name ?? '-',
                'email'        => $r->tamu->email ?? '-',
                'telepon'      => $r->tamu->phone ?? '-',
                'kamar'        => $r->tipe->detail_kamar ?? '-',
                'checkin'      => $ci ? $ci->translatedFormat('d M Y') : '-',
                'checkout'     => $co ? $co->translatedFormat('d M Y') : '-',
                'tgl_reservasi'=> $r->created_at ? $r->created_at->translatedFormat('d M Y') : '-',
                'durasi'       => $durasi . ' malam',
                'lantai'       => '-',
                'jumlah_tamu'  => '-',
                'total'        => 'Rp ' . number_format($total, 0, ',', '.'),
                'status'       => $r->status_reservasi ?? 'menunggu',
            ];
        });

        $totalPemesanan = $reservasis->count();
        $menunggu       = $reservasis->where('status', 'menunggu')->count();
        $dikonfirmasi   = $reservasis->where('status', 'dikonfirmasi')->count();
        $dibatalkan     = $reservasis->where('status', 'dibatalkan')->count();

        return view('pages.data_reservasi', compact(
            'reservasis',
            'totalPemesanan',
            'menunggu',
            'dikonfirmasi',
            'dibatalkan'
        ));
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

    // Batalkan reservasi oleh tamu dari dashboard
    public function batal($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->delete();

        return redirect()
            ->route('dashboard.tamu')
            ->with('success', 'Pemesanan berhasil dibatalkan.');
    }
}
