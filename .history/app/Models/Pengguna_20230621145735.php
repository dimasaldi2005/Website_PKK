<?php

namespace App\Models;


use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
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
}
