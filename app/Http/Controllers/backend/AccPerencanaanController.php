<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccperencanaanController extends Controller
{
    public function index()
    {
        $per1 = 0; $per2 = 0;

        // 1. ADMIN WEB (KABUPATEN)
        if (Auth::guard('web')->check()) {
            // MENUNGGU (Disetujui1)
            $per1 = DB::table('laporan_perencanaan_sehat')->where('status', 'Disetujui1')->count();
            // SELESAI (Disetujui2)
            $per2 = DB::table('laporan_perencanaan_sehat')->where('status', 'Disetujui2')->count();
        } 
        // 2. PENGGUNA MOBILE (KECAMATAN / DESA)
        elseif (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();
            if ($user->id_role == 2) { // KECAMATAN
                $desaIds = DB::table('users_mobile')->where('id_subdistrict', $user->id_subdistrict)->pluck('id');
                // MENUNGGU (Proses)
                $per1 = DB::table('laporan_perencanaan_sehat')->whereIn('id_user', $desaIds)->where('status', 'Proses')->count();
                // SELESAI (Disetujui1)
                $per2 = DB::table('laporan_perencanaan_sehat')->whereIn('id_user', $desaIds)->where('status', 'Disetujui1')->count();
            } else { // DESA
                $per1 = DB::table('laporan_perencanaan_sehat')->where('id_user', $user->id)->where('status', 'Proses')->count();
                $per2 = DB::table('laporan_perencanaan_sehat')->where('id_user', $user->id)->where('status', 'Disetujui1')->count();
            }
        }

        return view('backend.accperencanaan', compact('per1', 'per2'));
    }
}