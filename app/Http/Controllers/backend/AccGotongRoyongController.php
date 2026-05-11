<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccGotongRoyongController extends Controller
{
    public function index()
    {
        $got1 = 0;
        $got2 = 0;

        // 1. JIKA YANG LOGIN PENGGUNA MOBILE (KECAMATAN)
        if (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) { // Role Kecamatan
                // Menghitung yang masih 'proses' di desa naungannya
                $got1 = DB::table('laporan_gotong_royong')
                    ->join('users_mobile', 'laporan_gotong_royong.id_user', '=', 'users_mobile.id')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1)
                    ->whereIn('laporan_gotong_royong.status', ['proses', 'Proses', 'PROSES'])
                    ->count();

                // Menghitung yang 'Disetujui1' (Sudah di-ACC Kecamatan)
                $got2 = DB::table('laporan_gotong_royong')
                    ->join('users_mobile', 'laporan_gotong_royong.id_user', '=', 'users_mobile.id')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1)
                    ->whereIn('laporan_gotong_royong.status', ['Disetujui1', 'disetujui1', 'DISETUJUI1'])
                    ->count();
            }
        } 
        // 2. JIKA YANG LOGIN ADMIN WEB
        else if (Auth::guard('web')->check()) {
            // Admin menghitung SEMUA yang belum di-ACC final (baik yang baru masuk 'proses' maupun 'Disetujui1' dari kecamatan)
            $got1 = DB::table('laporan_gotong_royong')
                ->whereIn('status', ['proses', 'Proses', 'PROSES', 'Disetujui1', 'disetujui1', 'DISETUJUI1'])
                ->count();

            // Admin menghitung yang sudah selesai di-ACC Admin ('Disetujui2')
            $got2 = DB::table('laporan_gotong_royong')
                ->whereIn('status', ['Disetujui2', 'disetujui2', 'DISETUJUI2'])
                ->count();
        }

        return view('backend.accgotongroyong', compact('got1', 'got2'));
    }
}