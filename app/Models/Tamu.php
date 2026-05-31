<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Tamu extends Authenticatable
{
    use Notifiable;

    protected $table = 'tamu';

    protected $fillable = [
        'nik',
        'name',
        'email',
        'phone',
        'foto_tamu',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];
}