<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengguna extends Authenticatable
{
    protected $table = 'pengguna';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'alamat',
        'no_telepon',
        'jenis_kelamin',
        'foto_pengguna',
        'role'
    ];

    protected $hidden = [
        'password',
    ];
}