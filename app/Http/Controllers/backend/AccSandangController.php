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

        // 1. JIKA YANG LOGIN PENGGUNA MOBILE (KECAMATAN)
        if (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) { // Role Kecamatan
                // Menghitung yang masih 'proses' di desa naungannya
                $sand1 = DB::table('laporan_sandang')
                    ->join('users_mobile', 'laporan_sandang.id_user', '=', 'users_mobile.id')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1)
                    ->whereIn('laporan_sandang.status', ['proses', 'Proses', 'PROSES'])
                    ->count();

                // Menghitung yang 'Disetujui1' (Sudah di-ACC Kecamatan)
                $sand2 = DB::table('laporan_sandang')
                    ->join('users_mobile', 'laporan_sandang.id_user', '=', 'users_mobile.id')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1)
                    ->whereIn('laporan_sandang.status', ['Disetujui1', 'disetujui1', 'DISETUJUI1'])
                    ->count();
            }
        } 
        // 2. JIKA YANG LOGIN ADMIN WEB
        else if (Auth::guard('web')->check()) {
            // Admin menghitung SEMUA yang belum di-ACC final
            $sand1 = DB::table('laporan_sandang')
                ->whereIn('status', ['proses', 'Proses', 'PROSES', 'Disetujui1', 'disetujui1', 'DISETUJUI1'])
                ->count();

            // Admin menghitung yang sudah selesai di-ACC Admin
            $sand2 = DB::table('laporan_sandang')
                ->whereIn('status', ['Disetujui2', 'disetujui2', 'DISETUJUI2'])
                ->count();
        }

        return view('backend.accsandang', compact('sand1', 'sand2'));
    }
}