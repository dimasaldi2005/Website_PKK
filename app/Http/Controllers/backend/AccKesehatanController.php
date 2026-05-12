<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccKesehatanController extends Controller
{
    public function index()
    {
        $kes1 = 0; $kes2 = 0;

        // =====================================
        // 1. WEB KABUPATEN (Admin)
        // =====================================
        if (Auth::guard('web')->check()) {
            // MENUNGGU (Sudah di-ACC Kecamatan / Disetujui1)
            $kes1 = DB::table('laporan_bidang_kesehatan')->where('status', 'Disetujui1')->count();
            // SELESAI (Final / Disetujui2)
            $kes2 = DB::table('laporan_bidang_kesehatan')->where('status', 'Disetujui2')->count();
        } 
        // =====================================
        // 2. PENGGUNA MOBILE (Kecamatan / Desa)
        // =====================================
        else if (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();
            if ($user->id_role == 2) { // KECAMATAN
                $desaIds = DB::table('users_mobile')->where('id_subdistrict', $user->id_subdistrict)->pluck('id');
                // MENUNGGU (Proses)
                $kes1 = DB::table('laporan_bidang_kesehatan')->whereIn('id_user', $desaIds)->where('status', 'Proses')->count();
                // SELESAI (Sudah mereka ACC / Disetujui1)
                $kes2 = DB::table('laporan_bidang_kesehatan')->whereIn('id_user', $desaIds)->where('status', 'Disetujui1')->count();
            } else { // DESA
                $kes1 = DB::table('laporan_bidang_kesehatan')->where('id_user', $user->id)->where('status', 'Proses')->count();
                $kes2 = DB::table('laporan_bidang_kesehatan')->where('id_user', $user->id)->where('status', 'Disetujui1')->count();
            }
        }

        return view('backend.acckesehatan', compact('kes1', 'kes2'));
    }
}