<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengumuman extends Model
{
    use HasFactory;

    protected $fillable = [
        'judulPengumuman',
        'deskripsiPengumuman',
        'tempatPengumuman',
        'tanggalPengumuman'
    ];

    protected $dates = [
        'tanggalPengumuman',
        'created_at',
        'updated_at'
    ];

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['tanggalPengumuman'])
            ->translatedFormat('l, d M Y');
    }
}
