<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pengguna;
use PDORow;

class Pendidikan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pokja2_bidang1';
    protected $table = 'laporan_pendidikan_n_keterampilan';
    protected $guarded = ['id_pokja2_bidang1'];

    public function user()
    {
        return $this->belongsTo(Pengguna::class, 'id_user'); // sesuaikan kolom foreign key
    }
}
