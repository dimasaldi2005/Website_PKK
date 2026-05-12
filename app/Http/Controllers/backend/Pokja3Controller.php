<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\Sandang;
use App\Models\Pangan;
use App\Models\Perumahan;
use App\Models\LaporanPokja3;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengguna;
use Illuminate\Support\Facades\DB;

class Pokja3Controller extends Controller
{
    public function index()
    {
        $modelPertama = 0; // Pangan
        $modelKedua = 0;   // Sandang
        $modelKetiga = 0;  // Perumahan
        $modelKeempat = 0; // Kader Pokja 3

        // =====================================
        // 1. WEB KABUPATEN (ADMIN)
        // =====================================
        if (Auth::guard('web')->check()) {
            // Admin memantau yang sudah di-ACC Kecamatan (Disetujui1) dan yang Final (Disetujui2)
            $statusAdmin = ['Disetujui1', 'disetujui1', 'DISETUJUI1', 'Disetujui2', 'disetujui2', 'DISETUJUI2'];

            $modelPertama = Pangan::whereIn('status', $statusAdmin)->count();
            $modelKedua = Sandang::whereIn('status', $statusAdmin)->count();
            $modelKetiga = Perumahan::whereIn('status', $statusAdmin)->count();
            $modelKeempat = LaporanPokja3::whereIn('status', $statusAdmin)->count();
        } 
        
        // =====================================
        // 2. PENGGUNA MOBILE (KECAMATAN / DESA)
        // =====================================
        elseif (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) { 
                // --- KECAMATAN ---
                
                // JURUS ANTI-0: Cari semua ID user di bawah kecamatan tanpa filter role yang kaku
                $desaIds = DB::table('users_mobile')
                    ->where('id_subdistrict', $user->id_subdistrict)
                    ->pluck('id');

                // Kecamatan memantau yang masih Proses dan yang sudah mereka ACC (Disetujui1)
                $statusKecamatan = ['proses', 'Proses', 'PROSES', 'Disetujui1', 'disetujui1', 'DISETUJUI1'];

                $modelPertama = Pangan::whereIn('id_user', $desaIds)->whereIn('status', $statusKecamatan)->count();
                $modelKedua = Sandang::whereIn('id_user', $desaIds)->whereIn('status', $statusKecamatan)->count();
                $modelKetiga = Perumahan::whereIn('id_user', $desaIds)->whereIn('status', $statusKecamatan)->count();
                $modelKeempat = LaporanPokja3::whereIn('id_user', $desaIds)->whereIn('status', $statusKecamatan)->count();

            } else {
                // --- DESA ---
                // Menampilkan jumlah laporan milik desa itu sendiri agar dashboard tidak 0
                $modelPertama = Pangan::where('id_user', $user->id)->count();
                $modelKedua = Sandang::where('id_user', $user->id)->count();
                $modelKetiga = Perumahan::where('id_user', $user->id)->count();
                $modelKeempat = LaporanPokja3::where('id_user', $user->id)->count();
            }
        }

        return view('backend.pokja3', compact('modelPertama', 'modelKedua', 'modelKetiga', 'modelKeempat'));
    }
}