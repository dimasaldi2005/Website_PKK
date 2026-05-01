<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ttd extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_ttds';
    protected $table = 'ttds';
    protected $guarded = [
        'id_ttds'
    ];
}
