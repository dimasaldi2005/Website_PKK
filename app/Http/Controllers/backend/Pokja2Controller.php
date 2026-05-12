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
        $modelPertama = 0; // Pendidikan & Keterampilan
        $modelKedua = 0;   // Pengembangan Kehidupan Berkoprasi

        // =====================================
        // 1. WEB KABUPATEN (ADMIN)
        // =====================================
        if (Auth::guard('web')->check()) {
            
            // Admin Kabupaten memantau laporan yang sudah di-ACC Kecamatan (Disetujui1) dan Final (Disetujui2)
            $statusAdmin = ['Disetujui1', 'disetujui1', 'DISETUJUI1', 'Disetujui2', 'disetujui2', 'DISETUJUI2'];

            $modelPertama = DB::table('laporan_pendidikan_n_keterampilan')
                ->whereIn('status', $statusAdmin)
                ->count();

            $modelKedua = DB::table('laporan_pengembangan_kehidupan')
                ->whereIn('status', $statusAdmin)
                ->count();
        } 
        // =====================================
        // 2. PENGGUNA MOBILE (KECAMATAN / DESA)
        // =====================================
        elseif (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) { 
                // --- KECAMATAN ---
                
                // JURUS ANTI-0: Ambil semua ID user di wilayah kecamatan ini (Hapus filter id_role agar data tidak nyangkut)
                $desaIds = DB::table('users_mobile')
                    ->where('id_subdistrict', $user->id_subdistrict)
                    ->pluck('id');
                
                // Kecamatan memantau laporan yang masih 'Proses' dan yang sudah mereka ACC ('Disetujui1')
                $statusKecamatan = ['proses', 'Proses', 'PROSES', 'Disetujui1', 'disetujui1', 'DISETUJUI1'];

                $modelPertama = DB::table('laporan_pendidikan_n_keterampilan')
                    ->whereIn('id_user', $desaIds)
                    ->whereIn('status', $statusKecamatan)
                    ->count();

                $modelKedua = DB::table('laporan_pengembangan_kehidupan')
                    ->whereIn('id_user', $desaIds)
                    ->whereIn('status', $statusKecamatan)
                    ->count();

            } else {
                // --- DESA ---
                // Jika akun Desa yang login, tampilkan jumlah laporan miliknya sendiri
                
                $modelPertama = DB::table('laporan_pendidikan_n_keterampilan')
                    ->where('id_user', $user->id)
                    ->count();

                $modelKedua = DB::table('laporan_pengembangan_kehidupan')
                    ->where('id_user', $user->id)
                    ->count();
            }
        }

        return view('backend.pokja2', compact('modelPertama', 'modelKedua'));
    }
}