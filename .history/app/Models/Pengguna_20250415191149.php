<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengguna extends Authenticatable
{
    use HasFactory;
    protected $primaryKey = 'id_user';
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
