<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghayatan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_pokja1_bidang1';
    protected $table = 'laporan_penghayatan_n_pengamalan';
    protected $guarded = [
        'id_pokja1_bidang1'
    ];
}
