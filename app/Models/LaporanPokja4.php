<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPokja4 extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_kader_pokja4';
    protected $table = 'laporan_kader_pokja4';
    protected $guarded = [
        'id_kader_pokja4 '
    ];
}
