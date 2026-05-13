<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Pokja1Controller extends Controller
{
    public function index()
    {
        $modelPertama = 0;
        $modelKedua = 0;
        $modelKetiga = 0;

        // =====================================
        // WEB KABUPATEN
        // =====================================
        if (Auth::guard('web')->check()) {
            $statusAdmin = ['Disetujui1', 'Disetujui2'];

            $modelPertama = DB::table('laporan_penghayatan_n_pengamalan')
                ->whereIn('status', $statusAdmin)->count();

            $modelKedua = DB::table('laporan_gotong_royong')
                ->whereIn('status', $statusAdmin)->count();

            $modelKetiga = DB::table('laporan_kader_pokja1')
                ->whereIn('status', $statusAdmin)->count();
        }
        // =====================================
        // WEB KECAMATAN
        // =====================================
        else if (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) {
                $statusKecamatan = ['Proses', 'Disetujui1'];

                $modelPertama = DB::table('laporan_penghayatan_n_pengamalan')
                    ->leftJoin('users_mobile', 'laporan_penghayatan_n_pengamalan.id_user', '=', 'users_mobile.id')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->whereIn('laporan_penghayatan_n_pengamalan.status', $statusKecamatan)
                    ->count();

                $modelKedua = DB::table('laporan_gotong_royong')
                    ->leftJoin('users_mobile', 'laporan_gotong_royong.id_user', '=', 'users_mobile.id')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->whereIn('laporan_gotong_royong.status', $statusKecamatan)
                    ->count();

                $modelKetiga = DB::table('laporan_kader_pokja1')
                    ->leftJoin('users_mobile', 'laporan_kader_pokja1.id_user', '=', 'users_mobile.id')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->whereIn('laporan_kader_pokja1.status', $statusKecamatan)
                    ->count();
            }
        }

        return view('backend.pokja1', compact('modelPertama', 'modelKedua', 'modelKetiga'));
    }

    public function filter(Request $request)
    {
        /* Kode asli filter tetap dibiarkan utuh di project-mu */
    }

    public function cetak(Request $request)
    {
        /* Kode asli cetak tetap dibiarkan utuh di project-mu */
    }

    // ==========================================
    // FUNGSI BARU: EXPORT JSON POKJA 1
    // ==========================================
// ==========================================
    // FUNGSI BARU: EXPORT JSON POKJA 1
    // ==========================================
// ==========================================
    // FUNGSI BARU: EXPORT JSON POKJA 1
    // ==========================================
    public function getExportData(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $bidang = $request->bidang;

        // Pilih tabel berdasarkan bidang
        $tabel = '';
        if ($bidang == 'penghayatan') $tabel = 'laporan_penghayatan_n_pengamalan';
        elseif ($bidang == 'gotongroyong') $tabel = 'laporan_gotong_royong';
        elseif ($bidang == 'kader') $tabel = 'laporan_kader_pokja1';
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

            // ==========================================
            // 🧹 JURUS RAPI: BERSIHKAN KOLOM DATABASE
            // ==========================================
            $data->transform(function ($item) {
                // 1. Daftar kolom 'dapur' yang tidak boleh masuk ke Excel
                $kolomSampah = ['uuid', 'id_user', 'id_role', 'id_organization', 'created_at', 'updated_at'];
                
                foreach ($kolomSampah as $kolom) {
                    if (property_exists($item, $kolom)) {
                        unset($item->$kolom); // Buang kolomnya!
                    }
                }

                // 2. Hapus otomatis semua kolom Primary Key (yang depannya 'id_')
                foreach ((array) $item as $key => $value) {
                    if (strpos($key, 'id_') === 0) {
                        unset($item->$key);
                    }
                }

                // 3. Rapikan penulisan huruf pada status
                if (property_exists($item, 'status')) {
                    $item->status = ucfirst(strtolower($item->status));
                }

                return $item;
            });
            // ==========================================

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