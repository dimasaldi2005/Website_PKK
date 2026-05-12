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
        $data = collect(); // Biar aman kalau di blade ada looping data

        // =========================
        // 1. WEB KABUPATEN (ADMIN)
        // =========================
        if (Auth::guard('web')->check()) {

            // MENUNGGU ACC KABUPATEN (Hanya menghitung yang sudah di-ACC Kecamatan)
            $pang1 = DB::table('laporan_pangan')
                ->whereIn('status', ['Disetujui1', 'disetujui1', 'DISETUJUI1'])
                ->count();

            // SUDAH FINAL (Sudah di-ACC Kabupaten/Admin)
            $pang2 = DB::table('laporan_pangan')
                ->whereIn('status', ['Disetujui2', 'disetujui2', 'DISETUJUI2'])
                ->count();
        }

        // =========================
        // 2. PENGGUNA MOBILE (KECAMATAN / DESA)
        // =========================
        else if (Auth::guard('pengguna')->check()) {

            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) { // Role Kecamatan

                // JURUS ANTI-0: Cari semua ID user di bawah kecamatan ini tanpa filter role
                $desaUsers = DB::table('users_mobile')
                    ->where('id_subdistrict', $user->id_subdistrict)
                    ->pluck('id');

                // MENUNGGU PERSETUJUAN (Data mentah "Proses" dari desa)
                $pang1 = DB::table('laporan_pangan')
                    ->whereIn('id_user', $desaUsers)
                    ->whereIn('status', ['proses', 'Proses', 'PROSES'])
                    ->count();

                // SUDAH DISETUJUI (Data yang sudah di-ACC Kecamatan menjadi Disetujui1)
                $pang2 = DB::table('laporan_pangan')
                    ->whereIn('id_user', $desaUsers)
                    ->whereIn('status', ['Disetujui1', 'disetujui1', 'DISETUJUI1'])
                    ->count();
            } else {
                // UNTUK ROLE DESA (Opsional, agar dashboard desa juga muncul angkanya)
                $pang1 = DB::table('laporan_pangan')
                    ->where('id_user', $user->id)
                    ->whereIn('status', ['proses', 'Proses', 'PROSES'])
                    ->count();

                $pang2 = DB::table('laporan_pangan')
                    ->where('id_user', $user->id)
                    ->whereIn('status', ['Disetujui1', 'disetujui1', 'DISETUJUI1'])
                    ->count();
            }
        }

        return view('backend.accpangan', compact('pang1', 'pang2', 'data'));
    }
}