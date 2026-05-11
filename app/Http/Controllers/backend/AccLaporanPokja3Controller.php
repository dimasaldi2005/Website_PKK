<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccLaporanPokja3Controller extends Controller
{
    public function index()
    {
        $lap1 = 0;
        $lap2 = 0;
        $data = collect();

        // 1. JIKA YANG LOGIN PENGGUNA MOBILE (KECAMATAN)
        if (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) { // Role Kecamatan
                // Menghitung yang masih 'proses' di desa naungannya
                $lap1 = DB::table('laporan_kader_pokja3')
                    ->join('users_mobile', 'laporan_kader_pokja3.id_user', '=', 'users_mobile.id')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1)
                    ->whereIn('laporan_kader_pokja3.status', ['proses', 'Proses', 'PROSES'])
                    ->count();

                // Menghitung yang 'Disetujui1' (Sudah di-ACC Kecamatan)
                $lap2 = DB::table('laporan_kader_pokja3')
                    ->join('users_mobile', 'laporan_kader_pokja3.id_user', '=', 'users_mobile.id')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1)
                    ->whereIn('laporan_kader_pokja3.status', ['Disetujui1', 'disetujui1', 'DISETUJUI1'])
                    ->count();

                // Data untuk tabel review
                $data = DB::table('laporan_kader_pokja3')
                    ->leftJoin('users_mobile', 'laporan_kader_pokja3.id_user', '=', 'users_mobile.id')
                    ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('laporan_kader_pokja3.*', 'village.name as nama_desa')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->whereIn('laporan_kader_pokja3.status', ['proses', 'Proses', 'Disetujui1'])
                    ->orderBy('laporan_kader_pokja3.created_at', 'desc')
                    ->get();
            }
        } 
        // 2. JIKA YANG LOGIN ADMIN WEB
        else if (Auth::guard('web')->check()) {
            // Admin menghitung yang belum di-ACC final
            $lap1 = DB::table('laporan_kader_pokja3')
                ->whereIn('status', ['proses', 'Proses', 'Disetujui1', 'disetujui1'])
                ->count();

            // Admin menghitung yang sudah selesai di-ACC Admin
            $lap2 = DB::table('laporan_kader_pokja3')
                ->whereIn('status', ['Disetujui2', 'disetujui2', 'DISETUJUI2'])
                ->count();

            $data = DB::table('laporan_kader_pokja3')
                ->leftJoin('users_mobile', 'laporan_kader_pokja3.id_user', '=', 'users_mobile.id')
                ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('laporan_kader_pokja3.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                ->whereIn('laporan_kader_pokja3.status', ['Disetujui1', 'Disetujui2'])
                ->orderBy('laporan_kader_pokja3.created_at', 'desc')
                ->get();
        }

        return view('backend.acclaporanpokja3', compact('lap1', 'lap2', 'data'));
    }
}