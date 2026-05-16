<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapTahunan extends Model
{
    use HasFactory;

    protected $table = 'rekap_desa_tahunan';

    protected $primaryKey =
        'id_rekap_desa_tahunan';

    protected $guarded = [
        'id_rekap_desa_tahunan'
    ];
}