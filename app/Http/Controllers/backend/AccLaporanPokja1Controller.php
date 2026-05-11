<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccLaporanPokja1Controller extends Controller
{
    public function index()
    {
        $lap1 = 0; $lap2 = 0;

        // 1. CEK KABUPATEN DULU
        if (Auth::guard('web')->check()) { 
            // Kabupaten: Menunggu = Disetujui1 | Selesai = Disetujui2
            $lap1 = DB::table('laporan_kader_pokja1')->whereIn('status', ['Disetujui1', 'disetujui1', 'DISETUJUI1'])->count();
            $lap2 = DB::table('laporan_kader_pokja1')->whereIn('status', ['Disetujui2', 'disetujui2', 'DISETUJUI2'])->count();
        }
        // 2. CEK KECAMATAN
        elseif (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();
            if ($user->id_role == 2) { 
                // Kecamatan: Menunggu = Proses | Selesai = Disetujui1
                $lap1 = DB::table('laporan_kader_pokja1')
                    ->leftJoin('users_mobile', 'laporan_kader_pokja1.id_user', '=', 'users_mobile.id')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->whereIn('laporan_kader_pokja1.status', ['proses', 'Proses', 'PROSES'])
                    ->count();

                $lap2 = DB::table('laporan_kader_pokja1')
                    ->leftJoin('users_mobile', 'laporan_kader_pokja1.id_user', '=', 'users_mobile.id')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->whereIn('laporan_kader_pokja1.status', ['Disetujui1', 'disetujui1', 'DISETUJUI1'])
                    ->count();
            }
        }

        return view('backend.acclaporanpokja1', compact('lap1', 'lap2'));
    }
}