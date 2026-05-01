<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengguna extends Authenticatable
{
    use HasFactory, Notifiable, CanResetPassword;

    protected $fillable = [
        'nama_pengguna',
        'nama_kec',
        'no_whatsapp',
        'alamat',
        'password',
    ];

    // Sembunyikan kolom sensitive
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
