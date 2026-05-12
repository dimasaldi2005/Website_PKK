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
            // Admin melihat yang sudah di-ACC Kecamatan (Disetujui1) dan yang sudah Final (Disetujui2)
            $statusAdmin = ['Disetujui1', 'disetujui1', 'DISETUJUI1', 'Disetujui2', 'disetujui2', 'DISETUJUI2'];

            $modelPertama = DB::table('laporan_bidang_kesehatan')->whereIn('status', $statusAdmin)->count();
            $modelKedua   = DB::table('laporan_kelestarian_lingkungan_hidup')->whereIn('status', $statusAdmin)->count();
            $modelKetiga  = DB::table('laporan_perencanaan_sehat')->whereIn('status', $statusAdmin)->count();
            $modelKeempat = DB::table('laporan_kader_pokja4')->whereIn('status', $statusAdmin)->count();
            $modelKelima  = DB::table('rekap_desa_bulanan')->whereIn('status', $statusAdmin)->count();

            // FIX LOGIKA: Tabel sekarang sinkron dengan status Card (menggunakan whereIn)
            $data = DB::table('laporan_kader_pokja4')
                ->join('users_mobile', 'laporan_kader_pokja4.id_user', '=', 'users_mobile.id')
                ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->join('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('laporan_kader_pokja4.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                ->whereIn('laporan_kader_pokja4.status', $statusAdmin)
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
                // Kecamatan melihat data yang baru masuk (Proses) dan yang sudah mereka ACC (Disetujui1)
                $statusKec = ['proses', 'Proses', 'PROSES', 'Disetujui1', 'disetujui1', 'DISETUJUI1'];

                $modelPertama = DB::table('laporan_bidang_kesehatan')->whereIn('id_user', $desaIds)->whereIn('status', $statusKec)->count();
                $modelKedua   = DB::table('laporan_kelestarian_lingkungan_hidup')->whereIn('id_user', $desaIds)->whereIn('status', $statusKec)->count();
                $modelKetiga  = DB::table('laporan_perencanaan_sehat')->whereIn('id_user', $desaIds)->whereIn('status', $statusKec)->count();
                $modelKeempat = DB::table('laporan_kader_pokja4')->whereIn('id_user', $desaIds)->whereIn('status', $statusKec)->count();
                $modelKelima  = DB::table('rekap_desa_bulanan')->whereIn('id_user', $desaIds)->whereIn('status', $statusKec)->count();

                // FIX LOGIKA: Tabel sekarang sinkron dengan status Card (menggunakan whereIn)
                $data = DB::table('laporan_kader_pokja4')
                    ->join('users_mobile', 'laporan_kader_pokja4.id_user', '=', 'users_mobile.id')
                    ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->join('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('laporan_kader_pokja4.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->whereIn('laporan_kader_pokja4.status', $statusKec)
                    ->orderBy('id_kader_pokja4', 'desc')
                    ->get();
            } else { // DESA
                $modelPertama = DB::table('laporan_bidang_kesehatan')->where('id_user', $user->id)->count();
                $modelKetiga  = DB::table('laporan_perencanaan_sehat')->where('id_user', $user->id)->count();
                // Opsional: Jika ingin modelKedua, modelKeempat, modelKelima juga dihitung untuk Desa, tambahkan query-nya di sini

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

    // ==========================================
    // FUNGSI BARU: EXPORT JSON POKJA 4
    // ==========================================
    public function getExportData(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $bidang = $request->bidang;

        // Pilih tabel berdasarkan bidang yang dikirim dari Javascript
        $tabel = '';
        if ($bidang == 'kesehatan') $tabel = 'laporan_bidang_kesehatan';
        elseif ($bidang == 'kelestarian') $tabel = 'laporan_kelestarian_lingkungan_hidup';
        elseif ($bidang == 'perencanaan') $tabel = 'laporan_perencanaan_sehat';
        elseif ($bidang == 'kader') $tabel = 'laporan_kader_pokja4';
        else return response()->json(['status' => 'error', 'message' => 'Bidang tidak valid. Pastikan pilihan dropdown sudah benar.']);

        $statusTarget = ['Proses', 'proses', 'PROSES', 'Disetujui1', 'Disetujui2', 'disetujui1', 'disetujui2', 'DISETUJUI1', 'DISETUJUI2'];

        try {
            $query = DB::table($tabel)
                ->leftJoin('users_mobile', "$tabel.id_user", '=', 'users_mobile.id')
                ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('subdistrict.name as nama_kecamatan', 'village.name as nama_desa', "$tabel.*")
                ->whereIn("$tabel.status", $statusTarget);

            // Filter Role (Keamanan Data)
            if (Auth::guard('web')->check()) {
                // Admin: Biarkan query utuh (Tembus semua wilayah)
            } elseif (Auth::guard('pengguna')->check()) {
                $user = Auth::guard('pengguna')->user();
                if ($user->id_role == 2) {
                    // Kecamatan: Hanya narik desa yang satu kecamatan dengan dia
                    $query->where('users_mobile.id_subdistrict', $user->id_subdistrict);
                } else {
                    // Desa: Hanya narik laporannya sendiri
                    $query->where("$tabel.id_user", $user->id);
                }
            }

            // Filter Waktu
            if (!empty($bulan)) $query->whereMonth("$tabel.created_at", $bulan);
            if (!empty($tahun)) $query->whereYear("$tabel.created_at", $tahun);

            $data = $query->get();

            if ($data->isEmpty()) {
                return response()->json([
                    'status' => 'empty', 
                    'message' => 'Tidak ada data laporan pada periode tersebut.'
                ]);
            }

            return response()->json([
                'status' => 'success',
                'bidang' => strtoupper($bidang),
                'data' => $data
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error', 
                'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
            ], 500);
        }
    }
}