<?php

namespace App\Models;

// Jika file aslimu tidak menggunakan trait Notifications/HasApiTokens dsb,
// silakan sesuaikan use-statement di bawah dengan yang sudah ada di modelmu.
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use Notifiable;

    /**
     * Nama tabel — WAJIB, karena nama tabel bukan 'users' bawaan Laravel.
     */
    protected $table = 'pengguna';

    /**
     * Kolom yang boleh diisi lewat mass-assignment (create/update array).
     * INI YANG PALING SERING JADI PENYEBAB "data tidak tersimpan tanpa error".
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'alamat',
        'no_telepon',
        'jenis_kelamin',
        'foto_pengguna',
        'role',
    ];

    /**
     * Kolom yang disembunyikan saat model di-serialize (mis. ke JSON).
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting otomatis.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }
}