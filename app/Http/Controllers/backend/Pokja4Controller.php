<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Pokja4Controller extends Controller
{
    public function index()
    {
        // Default biar aman
        $modelPertama = 0;
        $modelKedua = 0;
        $modelKetiga = 0;
        $modelKeempat = 0;
        $modelKelima = 0;

        // Kumpulkan semua status agar terbaca sebagai "Total Laporan"
        $semuaStatus = ['Proses', 'proses', 'Disetujui1', 'Disetujui2'];

        // Jika login guard pengguna (Mobile/Desa/Kecamatan)
        if (Auth::guard('pengguna')->check()) {

            $user = Auth::guard('pengguna')->user();

            // Role 2: Kecamatan
            if ($user->id_role == 2) {
                // Cari ID Desa yang ada di kecamatan ini
                $desaIds = DB::table('users_mobile')
                    ->where('id_subdistrict', $user->id_subdistrict)
                    ->where('id_role', 1)
                    ->pluck('id');

                $modelPertama = DB::table('laporan_bidang_kesehatan')->whereIn('id_user', $desaIds)->whereIn('status', $semuaStatus)->count();
                $modelKedua   = DB::table('laporan_kelestarian_lingkungan_hidup')->whereIn('id_user', $desaIds)->whereIn('status', $semuaStatus)->count();
                $modelKetiga  = DB::table('laporan_perencanaan_sehat')->whereIn('id_user', $desaIds)->whereIn('status', $semuaStatus)->count();
                $modelKeempat = DB::table('laporan_kader_pokja4')->whereIn('id_user', $desaIds)->whereIn('status', $semuaStatus)->count();
                $modelKelima  = DB::table('rekap_desa_bulanan')->whereIn('id_user', $desaIds)->whereIn('status', $semuaStatus)->count();
            
            // Role 1: Desa
            } elseif ($user->id_role == 1) {
                $modelPertama = DB::table('laporan_bidang_kesehatan')->where('id_user', $user->id)->whereIn('status', $semuaStatus)->count();
                $modelKedua   = DB::table('laporan_kelestarian_lingkungan_hidup')->where('id_user', $user->id)->whereIn('status', $semuaStatus)->count();
                $modelKetiga  = DB::table('laporan_perencanaan_sehat')->where('id_user', $user->id)->whereIn('status', $semuaStatus)->count();
                $modelKeempat = DB::table('laporan_kader_pokja4')->where('id_user', $user->id)->whereIn('status', $semuaStatus)->count();
                $modelKelima  = DB::table('rekap_desa_bulanan')->where('id_user', $user->id)->whereIn('status', $semuaStatus)->count();
            }

        } else {
            // Guard web / admin (Menampilkan seluruh data se-kabupaten)
            $modelPertama = DB::table('laporan_bidang_kesehatan')->whereIn('status', $semuaStatus)->count();
            $modelKedua   = DB::table('laporan_kelestarian_lingkungan_hidup')->whereIn('status', $semuaStatus)->count();
            $modelKetiga  = DB::table('laporan_perencanaan_sehat')->whereIn('status', $semuaStatus)->count();
            $modelKeempat = DB::table('laporan_kader_pokja4')->whereIn('status', $semuaStatus)->count();
            $modelKelima  = DB::table('rekap_desa_bulanan')->whereIn('status', $semuaStatus)->count();
        }

        return view('backend.pokja4', compact(
            'modelPertama',
            'modelKedua',
            'modelKetiga',
            'modelKeempat',
            'modelKelima'
        ));
    }
}