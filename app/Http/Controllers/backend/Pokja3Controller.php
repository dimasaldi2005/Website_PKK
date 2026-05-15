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
            $statusAdmin = ['Disetujui1', 'Disetujui2'];

            $modelPertama = DB::table('laporan_pangan')
                ->leftJoin(
                    'users_mobile',
                    'laporan_pangan.id_user',
                    '=',
                    'users_mobile.id'
                )
                ->where(function ($query) {
                    // DESA
                    $query->where(function ($q) {
                        $q->where('users_mobile.id_role', 1)
                            ->whereIn(
                                'laporan_pangan.status',
                                ['Disetujui1', 'Disetujui2']
                            );
                    })
                        // MOBILE KECAMATAN
                        ->orWhere(function ($q) {
                            $q->where('users_mobile.id_role', 2)
                                ->whereIn(
                                    'laporan_pangan.status',
                                    ['Proses', 'proses', 'PROSES', 'Disetujui2']
                                );
                        });
                })
                ->count();

            $modelKedua = DB::table('laporan_sandang')
                ->leftJoin(
                    'users_mobile',
                    'laporan_sandang.id_user',
                    '=',
                    'users_mobile.id'
                )
                ->where(function ($query) {
                    // DESA
                    $query->where(function ($q) {
                        $q->where('users_mobile.id_role', 1)
                            ->whereIn(
                                'laporan_sandang.status',
                                ['Disetujui1', 'Disetujui2']
                            );
                    })
                        // MOBILE KECAMATAN
                        ->orWhere(function ($q) {
                            $q->where('users_mobile.id_role', 2)
                                ->whereIn(
                                    'laporan_sandang.status',
                                    ['Proses', 'proses', 'PROSES', 'Disetujui2']
                                );
                        });
                })
                ->count();

            $modelKetiga = DB::table('laporan_perumahan')
                ->leftJoin(
                    'users_mobile',
                    'laporan_perumahan.id_user',
                    '=',
                    'users_mobile.id'
                )
                ->where(function ($query) {
                    // DESA
                    $query->where(function ($q) {
                        $q->where('users_mobile.id_role', 1)
                            ->whereIn(
                                'laporan_perumahan.status',
                                ['Disetujui1', 'Disetujui2']
                            );
                    })
                        // MOBILE KECAMATAN
                        ->orWhere(function ($q) {
                            $q->where('users_mobile.id_role', 2)
                                ->whereIn(
                                    'laporan_perumahan.status',
                                    ['Proses', 'proses', 'PROSES', 'Disetujui2']
                                );
                        });
                })
                ->count();
            $modelKeempat = DB::table('laporan_kader_pokja3')
                ->leftJoin(
                    'users_mobile',
                    'laporan_kader_pokja3.id_user',
                    '=',
                    'users_mobile.id'
                )
                ->where(function ($query) {
                    // DESA
                    $query->where(function ($q) {
                        $q->where('users_mobile.id_role', 1)
                            ->whereIn(
                                'laporan_kader_pokja3.status',
                                ['Disetujui1', 'Disetujui2']
                            );
                    })
                        // MOBILE KECAMATAN
                        ->orWhere(function ($q) {
                            $q->where('users_mobile.id_role', 2)
                                ->whereIn(
                                    'laporan_kader_pokja3.status',
                                    ['Proses', 'proses', 'PROSES', 'Disetujui2']
                                );
                        });
                })
                ->count();
        }
        // =====================================
        // 2. PENGGUNA MOBILE (KECAMATAN / DESA)
        // =====================================
        elseif (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) {
                $statusKecamatan = ['Proses', 'Disetujui1'];

                $modelPertama = DB::table('laporan_pangan')
                    ->leftJoin('users_mobile', 'laporan_pangan.id_user', '=', 'users_mobile.id')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1)
                    ->whereIn('laporan_pangan.status', $statusKecamatan)
                    ->count();

                $modelKedua = DB::table('laporan_sandang')
                    ->leftJoin('users_mobile', 'laporan_sandang.id_user', '=', 'users_mobile.id')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1)
                    ->whereIn('laporan_sandang.status', $statusKecamatan)
                    ->count();

                $modelKetiga = DB::table('laporan_perumahan')
                    ->leftJoin('users_mobile', 'laporan_perumahan.id_user', '=', 'users_mobile.id')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1)
                    ->whereIn('laporan_perumahan.status', $statusKecamatan)
                    ->count();
                $modelKeempat = DB::table('laporan_kader_pokja3')
                    ->leftJoin('users_mobile', 'laporan_kader_pokja3.id_user', '=', 'users_mobile.id')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1)
                    ->whereIn('laporan_kader_pokja3.status', $statusKecamatan)
                    ->count();

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
