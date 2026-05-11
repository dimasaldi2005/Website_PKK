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
        $lap1 = 0;
        $lap2 = 0;

        if (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) { // Kecamatan
                $desaUsers = DB::table('users_mobile')
                    ->where('id_subdistrict', $user->id_subdistrict)
                    ->where('id_role', 1)
                    ->pluck('id');

                $lap1 = DB::table('laporan_kader_pokja4')
                    ->whereIn('id_user', $desaUsers)
                    ->whereIn('status', ['Proses', 'proses']) 
                    ->count();

                $lap2 = DB::table('laporan_kader_pokja4')
                    ->whereIn('id_user', $desaUsers)
                    ->where('status', 'Disetujui1')
                    ->count();
            } else { // Desa
                $lap1 = DB::table('laporan_kader_pokja4')
                    ->where('id_user', $user->id)
                    ->whereIn('status', ['Proses', 'proses']) 
                    ->count();

                $lap2 = DB::table('laporan_kader_pokja4')
                    ->where('id_user', $user->id)
                    ->where('status', 'Disetujui1')
                    ->count();
            }
        } elseif (Auth::guard('web')->check()) { // Admin Web
            // FIX: Admin bisa melihat yang masih Proses & Disetujui1
            $lap1 = DB::table('laporan_kader_pokja4')
                ->whereIn('status', ['Proses', 'proses', 'Disetujui1'])
                ->count();
                
            $lap2 = DB::table('laporan_kader_pokja4')
                ->where('status', 'Disetujui2')
                ->count();
        }

        return view('backend.acclaporanpokja4', compact('lap1', 'lap2'));
    }
}