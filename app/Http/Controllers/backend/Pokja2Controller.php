<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Pokja2Controller extends Controller
{
    public function index()
    {
        $modelPertama = 0; // Pendidikan
        $modelKedua = 0;   // Pengembangan

        // 1. JIKA YANG LOGIN ADMIN WEB
        if (Auth::guard('web')->check()) {
            
            // Admin melihat semua data yang ada di sistem
            $modelPertama = DB::table('laporan_pendidikan_n_keterampilan')
                ->whereIn('status', ['proses', 'Proses', 'PROSES', 'Disetujui1', 'disetujui1', 'DISETUJUI1', 'Disetujui2', 'disetujui2', 'DISETUJUI2'])
                ->count();

            $modelKedua = DB::table('laporan_pengembangan_kehidupan')
                ->whereIn('status', ['proses', 'Proses', 'PROSES', 'Disetujui1', 'disetujui1', 'DISETUJUI1', 'Disetujui2', 'disetujui2', 'DISETUJUI2'])
                ->count();
        } 
        // 2. JIKA YANG LOGIN PENGGUNA MOBILE (KECAMATAN)
        elseif (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) { // Kecamatan (role 2)
                
                // Ambil ID semua desa di bawah kecamatan ini
                $desaIds = DB::table('users_mobile')
                    ->where('id_subdistrict', $user->id_subdistrict)
                    ->where('id_role', 1)
                    ->pluck('id');

                // Hitung laporan khusus dari desa-desa tersebut
                $modelPertama = DB::table('laporan_pendidikan_n_keterampilan')
                    ->whereIn('id_user', $desaIds)
                    ->whereIn('status', ['proses', 'Proses', 'PROSES', 'Disetujui1', 'disetujui1', 'DISETUJUI1'])
                    ->count();

                $modelKedua = DB::table('laporan_pengembangan_kehidupan')
                    ->whereIn('id_user', $desaIds)
                    ->whereIn('status', ['proses', 'Proses', 'PROSES', 'Disetujui1', 'disetujui1', 'DISETUJUI1'])
                    ->count();
            }
        }

        return view('backend.pokja2', compact('modelPertama', 'modelKedua'));
    }
}