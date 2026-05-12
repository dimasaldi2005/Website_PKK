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
    // ==========================================
    // FUNGSI BARU: EXPORT JSON POKJA 3
    // ==========================================
    public function getExportData(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $bidang = $request->bidang;

        // Pilih tabel berdasarkan bidang
        $tabel = '';
        if ($bidang == 'pangan') $tabel = 'laporan_pangan';
        elseif ($bidang == 'sandang') $tabel = 'laporan_sandang';
        elseif ($bidang == 'perumahan') $tabel = 'laporan_perumahan_n_tata_laksana';
        elseif ($bidang == 'kader') $tabel = 'laporan_kader_pokja3';
        else return response()->json(['status' => 'error', 'message' => 'Bidang tidak valid.']);

        try {
            $query = DB::table($tabel)
                ->leftJoin('users_mobile', "$tabel.id_user", '=', 'users_mobile.id')
                ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('subdistrict.name as nama_kecamatan', 'village.name as nama_desa', "$tabel.*");

            // FILTER ROLE & STATUS (LOGIKA JURUS SAKTI)
            if (Auth::guard('web')->check()) {
                $statusAdmin = ['Disetujui1', 'disetujui1', 'DISETUJUI1', 'Disetujui2', 'disetujui2', 'DISETUJUI2'];
                $query->whereIn("$tabel.status", $statusAdmin);
            } elseif (Auth::guard('pengguna')->check()) {
                $user = Auth::guard('pengguna')->user();
                if ($user->id_role == 2) {
                    $statusKecamatan = ['Proses', 'proses', 'PROSES', 'Disetujui1', 'disetujui1', 'DISETUJUI1'];
                    $query->whereIn("$tabel.status", $statusKecamatan)
                          ->where('users_mobile.id_subdistrict', $user->id_subdistrict);
                } else {
                    $query->where("$tabel.id_user", $user->id);
                }
            }

            if (!empty($bulan)) $query->whereMonth("$tabel.created_at", $bulan);
            if (!empty($tahun)) $query->whereYear("$tabel.created_at", $tahun);

            $data = $query->get();

            if ($data->isEmpty()) {
                return response()->json(['status' => 'empty', 'message' => 'Tidak ada data laporan yang valid pada periode tersebut.']);
            }

            return response()->json([
                'status' => 'success',
                'bidang' => strtoupper($bidang),
                'data' => $data
            ]);

        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}