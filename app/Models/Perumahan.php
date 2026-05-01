<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perumahan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_pokja3_bidang3';
    protected $table = 'laporan_perumahan';
    protected $guarded = [
        'id_pokja3_bidang3'
    ];
}
