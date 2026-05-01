<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Tambahkan ini untuk format timestamp
    protected $dateFormat = 'Y-m-d H:i:s.u';
    public $timestamps = true;

    // Jika perlu custom nama kolom timestamp
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}