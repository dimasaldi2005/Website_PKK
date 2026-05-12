<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Pokja2Controller extends Controller
{
    public function index()
    {
        $modelPertama = 0; // Pendidikan & Keterampilan
        $modelKedua = 0;   // Pengembangan Kehidupan Berkoprasi

        // =====================================
        // 1. WEB KABUPATEN (ADMIN)
        // =====================================
        if (Auth::guard('web')->check()) {
            
            // Admin Kabupaten memantau laporan yang sudah di-ACC Kecamatan (Disetujui1) dan Final (Disetujui2)
            $statusAdmin = ['Disetujui1', 'disetujui1', 'DISETUJUI1', 'Disetujui2', 'disetujui2', 'DISETUJUI2'];

            $modelPertama = DB::table('laporan_pendidikan_n_keterampilan')
                ->whereIn('status', $statusAdmin)
                ->count();

            $modelKedua = DB::table('laporan_pengembangan_kehidupan')
                ->whereIn('status', $statusAdmin)
                ->count();
        } 
        // =====================================
        // 2. PENGGUNA MOBILE (KECAMATAN / DESA)
        // =====================================
        elseif (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) { 
                // --- KECAMATAN ---
                
                // JURUS ANTI-0: Ambil semua ID user di wilayah kecamatan ini (Hapus filter id_role agar data tidak nyangkut)
                $desaIds = DB::table('users_mobile')
                    ->where('id_subdistrict', $user->id_subdistrict)
                    ->pluck('id');
                
                // Kecamatan memantau laporan yang masih 'Proses' dan yang sudah mereka ACC ('Disetujui1')
                $statusKecamatan = ['proses', 'Proses', 'PROSES', 'Disetujui1', 'disetujui1', 'DISETUJUI1'];

                $modelPertama = DB::table('laporan_pendidikan_n_keterampilan')
                    ->whereIn('id_user', $desaIds)
                    ->whereIn('status', $statusKecamatan)
                    ->count();

                $modelKedua = DB::table('laporan_pengembangan_kehidupan')
                    ->whereIn('id_user', $desaIds)
                    ->whereIn('status', $statusKecamatan)
                    ->count();

            } else {
                // --- DESA ---
                // Jika akun Desa yang login, tampilkan jumlah laporan miliknya sendiri
                
                $modelPertama = DB::table('laporan_pendidikan_n_keterampilan')
                    ->where('id_user', $user->id)
                    ->count();

                $modelKedua = DB::table('laporan_pengembangan_kehidupan')
                    ->where('id_user', $user->id)
                    ->count();
            }
        }

        return view('backend.pokja2', compact('modelPertama', 'modelKedua'));
    }
    // ==========================================
    // FUNGSI BARU: EXPORT JSON POKJA 2
    // ==========================================
    public function getExportData(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $bidang = $request->bidang;

        // Pilih tabel berdasarkan bidang
        $tabel = '';
        if ($bidang == 'pendidikan') $tabel = 'laporan_pendidikan_n_keterampilan';
        elseif ($bidang == 'pengembangan') $tabel = 'laporan_pengembangan_kehidupan';
        // Opsional kalau ada Kader Pokja 2
        elseif ($bidang == 'kader') $tabel = 'laporan_kader_pokja2'; 
        else return response()->json(['status' => 'error', 'message' => 'Bidang tidak valid.']);

        try {
            $query = DB::table($tabel)
                ->leftJoin('users_mobile', "$tabel.id_user", '=', 'users_mobile.id')
                ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('subdistrict.name as nama_kecamatan', 'village.name as nama_desa', "$tabel.*");

            // FILTER ROLE & STATUS YANG BENAR
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

            // Filter Waktu
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
            return response()->json([
                'status' => 'error', 
                'message' => 'Error Baris ' . $e->getLine() . ': ' . $e->getMessage()
            ], 500);
        }
    }
}