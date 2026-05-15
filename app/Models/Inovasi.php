<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inovasi extends Model
{
    use HasFactory;

    protected $table = 'rekap_desa_bulanan';
    protected $primaryKey = 'id_rekap_desa_bulanan';
    protected $guarded = [
        'id_rekap_desa_bulanan'
    ];
}