<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    protected $table = 'reservasi';
    protected $primaryKey = 'id_reservasi';

    protected $fillable = [
        'tamu_id',
        'pengguna_id',
        'id_tipe',
        'check_in',
        'check_out',
        'status',
    ];

    protected $casts = [
        'check_in'  => 'date',
        'check_out' => 'date',
    ];

    public function tamu()
    {
        return $this->belongsTo(Tamu::class, 'tamu_id');
    }

    public function tipeKamar()
    {
        return $this->belongsTo(TipeKamar::class, 'id_tipe', 'id_tipe');
    }

    public function kamar()
    {
        return $this->hasOne(Kamar::class, 'id_tipe', 'id_tipe');
    }
}
