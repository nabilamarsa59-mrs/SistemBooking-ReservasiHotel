<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $table = 'kamar';

    protected $fillable = [
        'id_tipe',
        'no_kamar',
        'status_kamar'
    ];

    public function tipe()
    {
        return $this->belongsTo(
            TipeKamar::class,
            'id_tipe',
            'id_tipe'
        );
    }
}