<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $primaryKey = 'tanggal';
    protected $table = 'visitors';
    protected $fillable = [
        'tanggal',
    ];
}