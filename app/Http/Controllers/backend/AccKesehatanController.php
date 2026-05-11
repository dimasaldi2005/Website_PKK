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
        $kes1 = 0;
        $kes2 = 0;

        if (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) { // Kecamatan
                $desaUsers = DB::table('users_mobile')
                    ->where('id_subdistrict', $user->id_subdistrict)
                    ->where('id_role', 1)
                    ->pluck('id');

                $kes1 = DB::table('laporan_bidang_kesehatan')
                    ->whereIn('id_user', $desaUsers)
                    ->whereIn('status', ['Proses', 'proses']) 
                    ->count();

                $kes2 = DB::table('laporan_bidang_kesehatan')
                    ->whereIn('id_user', $desaUsers)
                    ->where('status', 'Disetujui1')
                    ->count();
            } else { // Desa
                $kes1 = DB::table('laporan_bidang_kesehatan')
                    ->where('id_user', $user->id)
                    ->whereIn('status', ['Proses', 'proses']) 
                    ->count();

                $kes2 = DB::table('laporan_bidang_kesehatan')
                    ->where('id_user', $user->id)
                    ->where('status', 'Disetujui1')
                    ->count();
            }
        } elseif (Auth::guard('web')->check()) { // Admin Web
            // FIX: Kita tambahkan 'Proses' agar admin bisa melihat antrean dari awal
            $kes1 = DB::table('laporan_bidang_kesehatan')
                ->whereIn('status', ['Proses', 'proses', 'Disetujui1'])
                ->count();
                
            $kes2 = DB::table('laporan_bidang_kesehatan')
                ->where('status', 'Disetujui2')
                ->count();
        }

        return view('backend.acckesehatan', compact('kes1', 'kes2'));
    }
}