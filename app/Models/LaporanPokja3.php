<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPokja3 extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_kader_pokja3';
    protected $table = 'laporan_kader_pokja3';
    protected $guarded = [
        'id_kader_pokja3 '
    ];
}
