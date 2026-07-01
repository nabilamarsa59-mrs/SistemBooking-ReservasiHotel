<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faktur extends Model
{
    protected $table = 'faktur';

    protected $primaryKey = 'no_faktur';

    protected $fillable = [
        'no_faktur',
        'id_reservasi',
        'nama_tamu',
        'tipe_kamar',
        'durasi',
        'total_tagihan',
        'tanggal_faktur',
    ];

    protected $casts = [
        'tanggal_faktur' => 'datetime',
        'total_tagihan'  => 'double',
    ];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi', 'id_reservasi');
    }
}