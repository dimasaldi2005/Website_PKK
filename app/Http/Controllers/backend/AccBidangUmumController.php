<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccBidangUmumController extends Controller
{
    public function index()
    {
        $got1 = 0; $got2 = 0;

        // =====================================
        // 1. WEB KABUPATEN (ADMIN)
        // =====================================
        if (Auth::guard('web')->check()) {
            // MENUNGGU (Sudah di-ACC Kecamatan / Disetujui1)
            $got1 = DB::table('laporan_umum')->where('status', 'Disetujui1')->count();
            // SELESAI (Final / Disetujui2)
            $got2 = DB::table('laporan_umum')->where('status', 'Disetujui2')->count();
        } 
        // =====================================
        // 2. PENGGUNA MOBILE (KECAMATAN / DESA)
        // =====================================
        else if (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();
            if ($user->id_role == 2) { // KECAMATAN
                $desaIds = DB::table('users_mobile')->where('id_subdistrict', $user->id_subdistrict)->pluck('id');
                // MENUNGGU (Proses dari Desa)
                $got1 = DB::table('laporan_umum')->whereIn('id_user', $desaIds)->where('status', 'Proses')->count();
                // SELESAI (Sudah mereka ACC / Disetujui1)
                $got2 = DB::table('laporan_umum')->whereIn('id_user', $desaIds)->where('status', 'Disetujui1')->count();
            } else { // DESA
                $got1 = DB::table('laporan_umum')->where('id_user', $user->id)->where('status', 'Proses')->count();
                $got2 = DB::table('laporan_umum')->where('id_user', $user->id)->whereIn('status', ['Disetujui1', 'Disetujui2'])->count();
            }
        }

        return view('backend.accbidangumum', compact('got1', 'got2'));
    }
}