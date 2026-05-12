<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccLaporanPokja4Controller extends Controller
{
    public function index()
    {
        $lap1 = 0; $lap2 = 0;

        // 1. ADMIN WEB (KABUPATEN)
        if (Auth::guard('web')->check()) {
            // MENUNGGU (Disetujui1)
            $lap1 = DB::table('laporan_kader_pokja4')->where('status', 'Disetujui1')->count();
            // SELESAI (Disetujui2)
            $lap2 = DB::table('laporan_kader_pokja4')->where('status', 'Disetujui2')->count();
        } 
        // 2. PENGGUNA MOBILE (KECAMATAN / DESA)
        elseif (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();
            if ($user->id_role == 2) { // KECAMATAN
                $desaIds = DB::table('users_mobile')->where('id_subdistrict', $user->id_subdistrict)->pluck('id');
                // MENUNGGU (Proses)
                $lap1 = DB::table('laporan_kader_pokja4')->whereIn('id_user', $desaIds)->where('status', 'Proses')->count();
                // SELESAI (Disetujui1)
                $lap2 = DB::table('laporan_kader_pokja4')->whereIn('id_user', $desaIds)->where('status', 'Disetujui1')->count();
            } else { // DESA
                $lap1 = DB::table('laporan_kader_pokja4')->where('id_user', $user->id)->where('status', 'Proses')->count();
                $lap2 = DB::table('laporan_kader_pokja4')->where('id_user', $user->id)->whereIn('status', ['Disetujui1', 'Disetujui2'])->count();
            }
        }

        return view('backend.acclaporanpokja4', compact('lap1', 'lap2'));
    }
}