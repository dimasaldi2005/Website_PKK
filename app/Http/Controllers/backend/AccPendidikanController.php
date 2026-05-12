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

        // =========================
        // 1. WEB KABUPATEN
        // =========================
        if (Auth::guard('web')->check()) {

            // MENUNGGU ACC KABUPATEN (Hanya melihat yang sudah di-ACC Kecamatan)
            $pend1 = DB::table('laporan_pendidikan_n_keterampilan')
                ->whereIn('status', ['Disetujui1', 'disetujui1', 'DISETUJUI1'])
                ->count();

            // SUDAH FINAL (Di-ACC Kabupaten)
            $pend2 = DB::table('laporan_pendidikan_n_keterampilan')
                ->whereIn('status', ['Disetujui2', 'disetujui2', 'DISETUJUI2'])
                ->count();
        }

        // =========================
        // 2. WEB KECAMATAN / DESA
        // =========================
        else if (Auth::guard('pengguna')->check()) {

            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) { // Role Kecamatan

                // JURUS ANTI-0: Cari semua ID user yang berada di bawah kecamatan ini tanpa filter id_role
                $desaUsers = DB::table('users_mobile')
                    ->where('id_subdistrict', $user->id_subdistrict)
                    ->pluck('id');

                // MENUNGGU PERSETUJUAN (Hanya melihat laporan mentah "Proses" dari desa)
                $pend1 = DB::table('laporan_pendidikan_n_keterampilan')
                    ->whereIn('id_user', $desaUsers)
                    ->whereIn('status', ['proses', 'Proses', 'PROSES'])
                    ->count();

                // SUDAH DISETUJUI (Sudah di-ACC Kecamatan menjadi Disetujui1)
                $pend2 = DB::table('laporan_pendidikan_n_keterampilan')
                    ->whereIn('id_user', $desaUsers)
                    ->whereIn('status', ['Disetujui1', 'disetujui1', 'DISETUJUI1'])
                    ->count();
            }
        }

        return view('backend.accpendidikan', compact('pend1', 'pend2'));
    }
}