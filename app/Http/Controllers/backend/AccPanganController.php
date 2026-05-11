<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccPanganController extends Controller
{
    public function index()
    {
        $pang1 = 0;
        $pang2 = 0;
        $data = collect(); // Default data kosong agar compact('data') tidak error di blade

        // 1. JIKA YANG LOGIN PENGGUNA MOBILE (KECAMATAN)
        if (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) { // Role Kecamatan
                // Menghitung yang masih 'proses' di desa naungannya
                $pang1 = DB::table('laporan_pangan')
                    ->join('users_mobile', 'laporan_pangan.id_user', '=', 'users_mobile.id')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1)
                    ->whereIn('laporan_pangan.status', ['proses', 'Proses', 'PROSES'])
                    ->count();

                // Menghitung yang 'Disetujui1' (Sudah di-ACC Kecamatan)
                $pang2 = DB::table('laporan_pangan')
                    ->join('users_mobile', 'laporan_pangan.id_user', '=', 'users_mobile.id')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1)
                    ->whereIn('laporan_pangan.status', ['Disetujui1', 'disetujui1', 'DISETUJUI1'])
                    ->count();
            }
        } 
        // 2. JIKA YANG LOGIN ADMIN WEB
        else if (Auth::guard('web')->check()) {
            // Admin menghitung SEMUA yang belum di-ACC final
            $pang1 = DB::table('laporan_pangan')
                ->whereIn('status', ['proses', 'Proses', 'PROSES', 'Disetujui1', 'disetujui1', 'DISETUJUI1'])
                ->count();

            // Admin menghitung yang sudah selesai di-ACC Admin
            $pang2 = DB::table('laporan_pangan')
                ->whereIn('status', ['Disetujui2', 'disetujui2', 'DISETUJUI2'])
                ->count();
        }

        return view('backend.accpangan', compact('pang1', 'pang2', 'data'));
    }
}