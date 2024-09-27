<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Jika admin adalah bagian dari autentikasi
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB; 

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang dapat diisi (fillable) di database.
     */
    protected $fillable = [
        'email',
        'phone',
        'password',
        'name',
        'bio',
        'role',
    ];

    /**
     * Kolom yang disembunyikan saat serialisasi.
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Tipe data yang harus di-cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

