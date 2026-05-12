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
        $modelPertama = 0; $modelKedua = 0; $modelKetiga = 0; $modelKeempat = 0; $modelKelima = 0;
        $data = collect();

        // =====================================
        // 1. WEB KABUPATEN (Admin)
        // =====================================
        if (Auth::guard('web')->check()) {
            $statusAdmin = ['Disetujui1', 'disetujui1', 'DISETUJUI1', 'Disetujui2', 'disetujui2', 'DISETUJUI2'];

            $modelPertama = DB::table('laporan_bidang_kesehatan')->whereIn('status', $statusAdmin)->count();
            $modelKedua   = DB::table('laporan_kelestarian_lingkungan_hidup')->whereIn('status', $statusAdmin)->count();
            $modelKetiga  = DB::table('laporan_perencanaan_sehat')->whereIn('status', $statusAdmin)->count();
            $modelKeempat = DB::table('laporan_kader_pokja4')->whereIn('status', $statusAdmin)->count();
            $modelKelima  = DB::table('rekap_desa_bulanan')->whereIn('status', $statusAdmin)->count();

            // Tabel Dashboard Admin: Hanya lihat yang sudah di-ACC Kecamatan (Disetujui1)
            $data = DB::table('laporan_kader_pokja4')
                ->join('users_mobile', 'laporan_kader_pokja4.id_user', '=', 'users_mobile.id')
                ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->join('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('laporan_kader_pokja4.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                ->where('laporan_kader_pokja4.status', 'Disetujui1')
                ->orderBy('id_kader_pokja4', 'desc')
                ->get();
        }
        // =====================================
        // 2. PENGGUNA MOBILE (Kecamatan / Desa)
        // =====================================
        else if (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();
            
            if ($user->id_role == 2) { // KECAMATAN
                $desaIds = DB::table('users_mobile')->where('id_subdistrict', $user->id_subdistrict)->pluck('id');
                $statusKec = ['proses', 'Proses', 'PROSES', 'Disetujui1', 'disetujui1', 'DISETUJUI1'];

                $modelPertama = DB::table('laporan_bidang_kesehatan')->whereIn('id_user', $desaIds)->whereIn('status', $statusKec)->count();
                $modelKedua   = DB::table('laporan_kelestarian_lingkungan_hidup')->whereIn('id_user', $desaIds)->whereIn('status', $statusKec)->count();
                $modelKetiga  = DB::table('laporan_perencanaan_sehat')->whereIn('id_user', $desaIds)->whereIn('status', $statusKec)->count();
                $modelKeempat = DB::table('laporan_kader_pokja4')->whereIn('id_user', $desaIds)->whereIn('status', $statusKec)->count();
                $modelKelima  = DB::table('rekap_desa_bulanan')->whereIn('id_user', $desaIds)->whereIn('status', $statusKec)->count();

                // Tabel Dashboard Kecamatan: Hanya lihat yang masih Proses
                $data = DB::table('laporan_kader_pokja4')
                    ->join('users_mobile', 'laporan_kader_pokja4.id_user', '=', 'users_mobile.id')
                    ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->join('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('laporan_kader_pokja4.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('laporan_kader_pokja4.status', 'Proses')
                    ->orderBy('id_kader_pokja4', 'desc')
                    ->get();
            } else { // DESA
                $modelPertama = DB::table('laporan_bidang_kesehatan')->where('id_user', $user->id)->count();
                $modelKetiga  = DB::table('laporan_perencanaan_sehat')->where('id_user', $user->id)->count();
                // ... dan seterusnya untuk model lain jika perlu

                $data = DB::table('laporan_kader_pokja4')
                    ->join('users_mobile', 'laporan_kader_pokja4.id_user', '=', 'users_mobile.id')
                    ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->join('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('laporan_kader_pokja4.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->where('laporan_kader_pokja4.id_user', $user->id)
                    ->orderBy('id_kader_pokja4', 'desc')
                    ->get();
            }
        }

        return view('backend.pokja4', compact('modelPertama', 'modelKedua', 'modelKetiga', 'modelKeempat', 'modelKelima', 'data'));
    }
}