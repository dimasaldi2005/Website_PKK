<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccSandangController extends Controller
{
    public function index()
    {
        $sand1 = 0;
        $sand2 = 0;

        // =====================================
        // 1. WEB KABUPATEN (ADMIN)
        // =====================================
        if (Auth::guard('web')->check()) {

            // MENUNGGU ACC KABUPATEN (Hanya menghitung yang sudah di-ACC Kecamatan)
            $sand1 = DB::table('laporan_sandang')
                ->whereIn('status', ['Disetujui1', 'disetujui1', 'DISETUJUI1'])
                ->count();

            // SUDAH FINAL (Sudah di-ACC Kabupaten/Admin)
            $sand2 = DB::table('laporan_sandang')
                ->whereIn('status', ['Disetujui2', 'disetujui2', 'DISETUJUI2'])
                ->count();
        } 
        
        // =====================================
        // 2. PENGGUNA MOBILE (KECAMATAN / DESA)
        // =====================================
        else if (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) { // Role Kecamatan
                
                // JURUS ANTI-0: Ambil semua ID user di bawah kecamatan ini
                $desaUsers = DB::table('users_mobile')
                    ->where('id_subdistrict', $user->id_subdistrict)
                    ->pluck('id');

                // MENUNGGU PERSETUJUAN (Data mentah "Proses" dari desa)
                $sand1 = DB::table('laporan_sandang')
                    ->whereIn('id_user', $desaUsers)
                    ->whereIn('status', ['proses', 'Proses', 'PROSES'])
                    ->count();

                // SUDAH DISETUJUI (Data yang sudah di-ACC Kecamatan menjadi Disetujui1)
                $sand2 = DB::table('laporan_sandang')
                    ->whereIn('id_user', $desaUsers)
                    ->whereIn('status', ['Disetujui1', 'disetujui1', 'DISETUJUI1'])
                    ->count();
            } else {
                // UNTUK ROLE DESA (Agar dashboard desa tidak 0)
                $sand1 = DB::table('laporan_sandang')
                    ->where('id_user', $user->id)
                    ->whereIn('status', ['proses', 'Proses', 'PROSES'])
                    ->count();

                $sand2 = DB::table('laporan_sandang')
                    ->where('id_user', $user->id)
                    ->whereIn('status', ['Disetujui1', 'Disetujui2'])
                    ->count();
            }
        }

        return view('backend.accsandang', compact('sand1', 'sand2'));
    }
}