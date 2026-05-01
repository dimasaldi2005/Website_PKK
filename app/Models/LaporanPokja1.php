<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class LaporanPokja1 extends Model
// {
//     use HasFactory;
//     protected $primaryKey = 'id_kader_pokja1';
//     protected $table = 'laporan_kader_pokja1';
//     protected $guarded = [
//         'id_kader_pokja1 '
//     ];
// }

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pengguna;

class LaporanPokja1 extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kader_pokja1';
    protected $table = 'laporan_kader_pokja1';
    protected $guarded = ['id_kader_pokja1'];

    // ✅ Relasi ke tabel users_mobile
    public function user()
    {
        return $this->belongsTo(Pengguna::class, 'id_user', 'id');
    }
}
