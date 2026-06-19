<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faktur extends Model
{
    protected $table = 'faktur';

    protected $fillable = [
        'id_faktur',
        'id_reservasi',
        'tanggal_cetak',
    ];

    protected $casts = [
        'tanggal_cetak' => 'datetime',
    ];

    /**     
     * @return array
     */
    public function cetakFaktur(): array
    {
        $reservasi = $this->reservasi()->with([
            'tamu',
            'kamar.tipeKamar',
            'pembayaran',
        ])->first();

        // Hitung durasi menginap
        $checkin  = $reservasi->tanggal_checkin;
        $checkout = $reservasi->tanggal_checkout;
        $durasi   = $checkin->diffInDays($checkout);

        // Hitung total harga
        $hargaPerMalam = $reservasi->kamar->harga;
        $totalHarga    = $hargaPerMalam * $durasi;

        return [
            'id_faktur'     => $this->id_faktur,
            'tanggal_cetak' => $this->tanggal_cetak
                                    ? $this->tanggal_cetak->format('d/m/Y H:i')
                                    : now()->format('d/m/Y H:i'),
            'tamu' => [
                'nama'  => $reservasi->tamu->name  ?? $reservasi->tamu->nama,
                'email' => $reservasi->tamu->email,
                'nik'   => $reservasi->tamu->nik   ?? '-',
                'phone' => $reservasi->tamu->phone ?? '-',
            ],
            'kamar' => [
                'nomor_kamar' => $reservasi->kamar->nomor_kamar,
                'tipe'        => $reservasi->kamar->tipeKamar->nama_tipe ?? '-',
                'fasilitas'   => $reservasi->kamar->tipeKamar->fasilitas ?? '-',
            ],
            'reservasi' => [
                'id_reservasi'     => $reservasi->id_reservasi,
                'tanggal_checkin'  => $checkin->format('d/m/Y'),
                'tanggal_checkout' => $checkout->format('d/m/Y'),
                'durasi_malam'     => $durasi,
            ],
            'pembayaran' => [
                'harga_per_malam' => $hargaPerMalam,
                'total_bayar'     => $totalHarga,
                'status'          => $reservasi->pembayaran?->status_verifikasi
                                        ? 'Lunas'
                                        : 'Belum Lunas',
            ],
        ];
    }

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi');
    }
}