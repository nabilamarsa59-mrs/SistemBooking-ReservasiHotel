<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Faktur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{

    public function index()
    {
        $data = Pembayaran::with('faktur.reservasi.tamu')->latest('id_pembayaran')->get();

        $pembayaran = $data->map(function ($item) {
            $faktur    = $item->faktur;
            $reservasi = $faktur?->reservasi;
            $tamu      = $reservasi?->tamu;

            $status = match ($item->status_pembayaran) {
                'lunas'   => 'terverifikasi',
                'pending' => 'menunggu',
                default   => 'menunggu',
            };

            return [
                'id_pembayaran' => $item->id_pembayaran,
                'id'            => '#RSV-' . str_pad($reservasi->id_reservasi ?? 0, 3, '0', STR_PAD_LEFT),
                'nama'          => $tamu->name ?? '-',
                'metode'        => $item->metode_pembayaran ?? '-',
                'jumlah'        => 'Rp ' . number_format($item->jumlah_bayar ?? 0, 0, ',', '.'),
                'tanggal'       => $item->tanggal_pembayaran
                                    ? $item->tanggal_pembayaran->translatedFormat('d M Y')
                                    : '-',
                'status'        => $status,
                'bukti'         => $item->bukti_pembayaran
                                    ? asset('storage/' . $item->bukti_pembayaran)
                                    : '',
            ];
        });

        $statistik = [
            'menunggu'      => $pembayaran->where('status', 'menunggu')->count(),
            'terverifikasi' => $pembayaran->where('status', 'terverifikasi')->count(),
        ];

        return view('pages.verifikasi_admin', compact('pembayaran', 'statistik'));
    }

    public function detail($id)
    {
        $pembayaran = Pembayaran::with('faktur.reservasi.tamu')->findOrFail($id);

        return view('pages.detail_pembayaran', compact('pembayaran'));
    }

    public function verifikasi(Request $request, $id)
    {
        $request->validate([
            'diterima' => 'required|in:0,1',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);

        $diterima = $request->input('diterima') == '1';

        $pembayaran->verifikasiPembayaran($diterima);

        return redirect()
            ->route('verifikasi.pembayaran')
            ->with('success', $diterima
                ? 'Pembayaran berhasil diverifikasi, reservasi tamu sudah aktif.'
                : 'Pembayaran ditolak, tamu perlu upload ulang bukti.');
    }

    public function bayarForm($no_faktur)
    {
        $faktur = Faktur::with('reservasi.tamu')->where('no_faktur', $no_faktur)->firstOrFail();
        $tamu   = Auth::guard('tamu')->user();

        if ($faktur->reservasi->tamu_id !== $tamu->id) {
            abort(403);
        }

        $pembayaran = Pembayaran::where('no_faktur', $no_faktur)->first();

        return view('pages.bayar', compact('faktur', 'pembayaran'));
    }

    public function bayar(Request $request, $no_faktur)
    {
        $request->validate([
            'metode_pembayaran' => 'required|string',
            'bukti_pembayaran'  => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $faktur = Faktur::where('no_faktur', $no_faktur)->firstOrFail();
        $tamu   = Auth::guard('tamu')->user();

        if ($faktur->reservasi->tamu_id !== $tamu->id) {
            abort(403);
        }

        $pembayaranLama = Pembayaran::where('no_faktur', $no_faktur)->first();

        if ($pembayaranLama && $pembayaranLama->bukti_pembayaran) {
            Storage::disk('public')->delete($pembayaranLama->bukti_pembayaran);
        }

        $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        Pembayaran::updateOrCreate(
            ['no_faktur' => $no_faktur],
            [
                'tanggal_pembayaran' => now(),
                'metode_pembayaran'  => $request->metode_pembayaran,
                'jumlah_bayar'       => $faktur->total_tagihan,
                'status_pembayaran'  => 'pending',
                'bukti_pembayaran'   => $path,
            ]
        );

        return redirect()
            ->route('dashboard.tamu')
            ->with('success', 'Bukti pembayaran berhasil diupload, menunggu verifikasi admin.');
    }
}