<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GotongRoyong extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_pokja1_bidang2';
    protected $table = 'laporan_gotong_royong';
    protected $guarded = [
        'id_pokja1_bidang2'
    ];
}
