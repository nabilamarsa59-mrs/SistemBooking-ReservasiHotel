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
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */

    public function tamu()
    {
        return $this->belongsTo(Tamu::class, 'tamu_id');
    }

    public function pengguna()
    {
        return $this->belongsTo(pengguna::class, 'pengguna_id');
    }

    public function tipe()
    {
        return $this->belongsTo(TipeKamar::class, 'id_tipe');
    }
}