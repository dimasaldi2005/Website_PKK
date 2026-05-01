<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kesehatan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_pokja4_bidang1';
    protected $table = 'laporan_bidang_kesehatan';
    protected $guarded = [
        'id_pokja4_bidang1'
    ];
}
