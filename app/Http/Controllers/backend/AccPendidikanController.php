<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccPendidikanController extends Controller
{
    public function index()
    {
        $pend1 = 0;
        $pend2 = 0;

        // 1. JIKA YANG LOGIN PENGGUNA MOBILE (KECAMATAN)
        if (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) { // Role Kecamatan
                // Menghitung yang masih 'proses' di desa naungannya
                $pend1 = DB::table('laporan_pendidikan_n_keterampilan')
                    ->join('users_mobile', 'laporan_pendidikan_n_keterampilan.id_user', '=', 'users_mobile.id')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1)
                    ->whereIn('laporan_pendidikan_n_keterampilan.status', ['proses', 'Proses', 'PROSES'])
                    ->count();

                // Menghitung yang 'Disetujui1' (Sudah di-ACC Kecamatan)
                $pend2 = DB::table('laporan_pendidikan_n_keterampilan')
                    ->join('users_mobile', 'laporan_pendidikan_n_keterampilan.id_user', '=', 'users_mobile.id')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1)
                    ->whereIn('laporan_pendidikan_n_keterampilan.status', ['Disetujui1', 'disetujui1', 'DISETUJUI1'])
                    ->count();
            }
        } 
        // 2. JIKA YANG LOGIN ADMIN WEB
        else if (Auth::guard('web')->check()) {
            // Admin menghitung SEMUA yang belum di-ACC final
            $pend1 = DB::table('laporan_pendidikan_n_keterampilan')
                ->whereIn('status', ['proses', 'Proses', 'PROSES', 'Disetujui1', 'disetujui1', 'DISETUJUI1'])
                ->count();

            // Admin menghitung yang sudah selesai di-ACC Admin
            $pend2 = DB::table('laporan_pendidikan_n_keterampilan')
                ->whereIn('status', ['Disetujui2', 'disetujui2', 'DISETUJUI2'])
                ->count();
        }

        return view('backend.accpendidikan', compact('pend1', 'pend2'));
    }
}