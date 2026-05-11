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

class Pokja3Controller extends Controller
{
    public function index()
    {
        $modelPertama = 0;
        $modelKedua = 0;
        $modelKetiga = 0;
        $modelKeempat = 0;

        // 1. JIKA YANG LOGIN ADMIN WEB
        if (Auth::guard('web')->check()) {
            // Admin melihat semua data yang masuk di sistem
            $semuaStatusAdmin = ['proses', 'Proses', 'PROSES', 'Disetujui1', 'disetujui1', 'DISETUJUI1', 'Disetujui2', 'disetujui2', 'DISETUJUI2'];
            
            $modelPertama = Pangan::whereIn('status', $semuaStatusAdmin)->count();
            $modelKedua = Sandang::whereIn('status', $semuaStatusAdmin)->count();
            $modelKetiga = Perumahan::whereIn('status', $semuaStatusAdmin)->count();
            $modelKeempat = LaporanPokja3::whereIn('status', $semuaStatusAdmin)->count();
            
        } 
        // 2. JIKA YANG LOGIN PENGGUNA MOBILE (KECAMATAN)
        elseif (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) { // Role Kecamatan
                // Ambil ID semua desa (role 1) di kecamatan tersebut
                $desaIds = Pengguna::where('id_subdistrict', $user->id_subdistrict)
                    ->where('id_role', 1)
                    ->pluck('id');

                $statusKecamatan = ['proses', 'Proses', 'PROSES', 'Disetujui1', 'disetujui1', 'DISETUJUI1'];

                $modelPertama = Pangan::whereIn('id_user', $desaIds)
                    ->whereIn('status', $statusKecamatan)
                    ->count();

                $modelKedua = Sandang::whereIn('id_user', $desaIds)
                    ->whereIn('status', $statusKecamatan)
                    ->count();

                $modelKetiga = Perumahan::whereIn('id_user', $desaIds)
                    ->whereIn('status', $statusKecamatan)
                    ->count();

                $modelKeempat = LaporanPokja3::whereIn('id_user', $desaIds)
                    ->whereIn('status', $statusKecamatan)
                    ->count();
            }
        }

        return view('backend.pokja3', compact('modelPertama', 'modelKedua', 'modelKetiga', 'modelKeempat'));
    }
}