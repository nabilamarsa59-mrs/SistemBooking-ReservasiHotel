<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipeKamar extends Model
{
    protected $table = 'tipe_kamar';

    protected $primaryKey = 'id_tipe';

    protected $fillable = [
        'detail_kamar',
        'harga_kamar',
        'fasilitas',
        'foto_kamar'
    ];

    public function kamar()
    {
        return $this->hasMany(Kamar::class, 'id_tipe', 'id_tipe');
    }
}