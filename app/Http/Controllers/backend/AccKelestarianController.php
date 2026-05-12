<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccKelestarianController extends Controller
{
    public function index()
    {
        $kel1 = 0; $kel2 = 0;

        // 1. ADMIN WEB (KABUPATEN)
        if (Auth::guard('web')->check()) {
            // MENUNGGU (Sudah di-ACC Kecamatan / Disetujui1)
            $kel1 = DB::table('laporan_kelestarian_lingkungan_hidup')->where('status', 'Disetujui1')->count();
            // SELESAI (Final / Disetujui2)
            $kel2 = DB::table('laporan_kelestarian_lingkungan_hidup')->where('status', 'Disetujui2')->count();
        } 
        // 2. PENGGUNA MOBILE (KECAMATAN / DESA)
        elseif (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();
            if ($user->id_role == 2) { // KECAMATAN
                $desaIds = DB::table('users_mobile')->where('id_subdistrict', $user->id_subdistrict)->pluck('id');
                // MENUNGGU (Proses)
                $kel1 = DB::table('laporan_kelestarian_lingkungan_hidup')->whereIn('id_user', $desaIds)->where('status', 'Proses')->count();
                // SELESAI (Sudah mereka ACC / Disetujui1)
                $kel2 = DB::table('laporan_kelestarian_lingkungan_hidup')->whereIn('id_user', $desaIds)->where('status', 'Disetujui1')->count();
            } else { // DESA
                $kel1 = DB::table('laporan_kelestarian_lingkungan_hidup')->where('id_user', $user->id)->where('status', 'Proses')->count();
                $kel2 = DB::table('laporan_kelestarian_lingkungan_hidup')->where('id_user', $user->id)->where('status', 'Disetujui1')->count();
            }
        }

        return view('backend.acckelestarian', compact('kel1', 'kel2'));
    }
}