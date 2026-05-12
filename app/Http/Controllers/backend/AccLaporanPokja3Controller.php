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

        // =====================================
        // 1. WEB KABUPATEN (ADMIN)
        // =====================================
        if (Auth::guard('web')->check()) {
            // MENUNGGU ACC KABUPATEN (Hanya menghitung yang sudah di-ACC Kecamatan)
            $lap1 = DB::table('laporan_kader_pokja3')
                ->whereIn('status', ['Disetujui1', 'disetujui1', 'DISETUJUI1'])
                ->count();

            // SUDAH FINAL (Sudah di-ACC Admin)
            $lap2 = DB::table('laporan_kader_pokja3')
                ->whereIn('status', ['Disetujui2', 'disetujui2', 'DISETUJUI2'])
                ->count();

            // Ambil data yang perlu di-review (Disetujui1)
            $data = DB::table('laporan_kader_pokja3')
                ->leftJoin('users_mobile', 'laporan_kader_pokja3.id_user', '=', 'users_mobile.id')
                ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('laporan_kader_pokja3.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                ->where('laporan_kader_pokja3.status', 'Disetujui1')
                ->orderBy('laporan_kader_pokja3.created_at', 'desc')
                ->get();
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
                $lap1 = DB::table('laporan_kader_pokja3')
                    ->whereIn('id_user', $desaUsers)
                    ->whereIn('status', ['proses', 'Proses', 'PROSES'])
                    ->count();

                // SUDAH DISETUJUI (Data yang sudah di-ACC Kecamatan menjadi Disetujui1)
                $lap2 = DB::table('laporan_kader_pokja3')
                    ->whereIn('id_user', $desaUsers)
                    ->whereIn('status', ['Disetujui1', 'disetujui1', 'DISETUJUI1'])
                    ->count();

                // Ambil data yang perlu di-review (Proses)
                $data = DB::table('laporan_kader_pokja3')
                    ->leftJoin('users_mobile', 'laporan_kader_pokja3.id_user', '=', 'users_mobile.id')
                    ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('laporan_kader_pokja3.*', 'village.name as nama_desa')
                    ->whereIn('laporan_kader_pokja3.id_user', $desaUsers)
                    ->whereIn('laporan_kader_pokja3.status', ['proses', 'Proses'])
                    ->orderBy('laporan_kader_pokja3.created_at', 'desc')
                    ->get();
            } else {
                // Untuk Desa
                $lap1 = DB::table('laporan_kader_pokja3')->where('id_user', $user->id)->where('status', 'Proses')->count();
                $lap2 = DB::table('laporan_kader_pokja3')->where('id_user', $user->id)->whereIn('status', ['Disetujui1', 'Disetujui2'])->count();
            }
        }

        return view('backend.acclaporanpokja3', compact('lap1', 'lap2', 'data'));
    }
}