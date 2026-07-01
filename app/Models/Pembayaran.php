<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
        'no_faktur',
        'tanggal_pembayaran',
        'metode_pembayaran',
        'jumlah_bayar',
        'status_pembayaran',
        'bukti_pembayaran',
    ];

    protected $casts = [
        'tanggal_pembayaran' => 'date',
    ];

    public function faktur()
    {
        return $this->belongsTo(Faktur::class, 'no_faktur', 'no_faktur');
    }

    public function uploadBukti(string $pathFile): bool
    {
        return $this->update([
            'bukti_pembayaran'  => $pathFile,
            'status_pembayaran' => 'pending',
        ]);
    }

    public function verifikasiPembayaran(bool $diterima = true): bool
    {
        $this->update([
            'status_pembayaran' => $diterima ? 'lunas' : 'pending',
        ]);

        $reservasi = $this->faktur?->reservasi;

        if ($reservasi) {
            $reservasi->update([
                'status_reservasi' => $diterima ? 'aktif' : 'pending',
            ]);
        }

        return true;
    }
}