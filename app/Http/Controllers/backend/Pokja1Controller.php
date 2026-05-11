<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Pokja1Controller extends Controller
{
    public function index()
    {
        $modelPertama = 0; $modelKedua = 0; $modelKetiga = 0;

        // 1. CEK KABUPATEN DULU
        if (Auth::guard('web')->check()) { 
            $statusAdmin = ['Disetujui1', 'disetujui1', 'DISETUJUI1', 'Disetujui2', 'disetujui2', 'DISETUJUI2'];

            $modelPertama = DB::table('laporan_penghayatan_n_pengamalan')->whereIn('status', $statusAdmin)->count();
            $modelKedua = DB::table('laporan_gotong_royong')->whereIn('status', $statusAdmin)->count();
            $modelKetiga = DB::table('laporan_kader_pokja1')->whereIn('status', $statusAdmin)->count();
        } 
        // 2. CEK KECAMATAN
        else if (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();
            
            if ($user->id_role == 2) { 
                $statusKecamatan = ['proses', 'Proses', 'PROSES', 'Disetujui1', 'disetujui1', 'DISETUJUI1'];

                $modelPertama = DB::table('laporan_penghayatan_n_pengamalan')
                    ->leftJoin('users_mobile', 'laporan_penghayatan_n_pengamalan.id_user', '=', 'users_mobile.id')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->whereIn('laporan_penghayatan_n_pengamalan.status', $statusKecamatan)
                    ->count();

                $modelKedua = DB::table('laporan_gotong_royong')
                    ->leftJoin('users_mobile', 'laporan_gotong_royong.id_user', '=', 'users_mobile.id')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->whereIn('laporan_gotong_royong.status', $statusKecamatan)
                    ->count();

                $modelKetiga = DB::table('laporan_kader_pokja1')
                    ->leftJoin('users_mobile', 'laporan_kader_pokja1.id_user', '=', 'users_mobile.id')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->whereIn('laporan_kader_pokja1.status', $statusKecamatan)
                    ->count();
            }
        }

        return view('backend.pokja1', compact('modelPertama', 'modelKedua', 'modelKetiga'));
    }

    public function filter(Request $request) { /* Kode asli */ }
    public function cetak(Request $request) { /* Kode asli */ }
}