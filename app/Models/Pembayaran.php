<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $fillable = [
        'id_pembayaran',    
        'id_reservasi',   
        'total_bayar',       
        'bukti_transfer',    
        'status_verifikasi', 
    ];

    protected $casts = [
        'total_bayar'       => 'double',
        'status_verifikasi' => 'boolean',
    ];

    /**
     * @param string $pathFile 
     * @return bool 
     */
    public function uploadBukti(string $pathFile): bool
    {
        return $this->update([
            'bukti_transfer'    => $pathFile,
            'status_verifikasi' => false, 
        ]);
    }

    /**
     * @param bool $diterima 
     * @return bool
     */
    public function verifikasiPembayaran(bool $diterima = true): bool
    {
        $this->update(['status_verifikasi' => $diterima]);

        if ($diterima) {
            // Konfirmasi reservasi
            $this->reservasi->update(['status_reservasi' => 'dikonfirmasi']);

            // Auto-buat faktur jika belum ada
            if (!$this->reservasi->faktur()->exists()) {
                Faktur::create([
                    'id_reservasi'  => $this->id_reservasi,
                    'tanggal_cetak' => now(),
                ]);
            }
        } else {
            // Kembalikan ke pending agar tamu bisa upload ulang
            $this->reservasi->update(['status_reservasi' => 'pending']);
        }

        return true;
    }

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi');
    }
}