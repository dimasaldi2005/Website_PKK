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
        $kel1 = 0;
        $kel2 = 0;

        // Cek guard yang aktif
        if (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) { // Kecamatan
                $desaUsers = DB::table('users_mobile')
                    ->where('id_subdistrict', $user->id_subdistrict)
                    ->where('id_role', 1)
                    ->pluck('id');

                $kel1 = DB::table('laporan_kelestarian_lingkungan_hidup')
                    ->whereIn('id_user', $desaUsers)
                    ->whereIn('status', ['Proses', 'proses'])
                    ->count();

                $kel2 = DB::table('laporan_kelestarian_lingkungan_hidup')
                    ->whereIn('id_user', $desaUsers)
                    ->where('status', 'Disetujui1')
                    ->count();
            } else { // Desa
                $kel1 = DB::table('laporan_kelestarian_lingkungan_hidup')
                    ->where('id_user', $user->id)
                    ->whereIn('status', ['Proses', 'proses'])
                    ->count();

                $kel2 = DB::table('laporan_kelestarian_lingkungan_hidup')
                    ->where('id_user', $user->id)
                    ->where('status', 'Disetujui1')
                    ->count();
            }
        } elseif (Auth::guard('web')->check()) { 
            // Admin web
            // FIX: Tambahkan Proses agar admin melihat antrean awal
            $kel1 = DB::table('laporan_kelestarian_lingkungan_hidup')
                ->whereIn('status', ['Proses', 'proses', 'Disetujui1'])
                ->count();
                
            $kel2 = DB::table('laporan_kelestarian_lingkungan_hidup')
                ->where('status', 'Disetujui2')
                ->count();
        }

        return view('backend.acckelestarian', compact('kel1', 'kel2'));
    }
}