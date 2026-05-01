<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidangUmum extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_laporan_umum';
    protected $table = 'laporan_umum';
    protected $guarded = [
        'id_laporan_umum'
    ];
}