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
        $modelPertama = 0;
        $modelKedua = 0;
        $modelKetiga = 0;
        $modelKeempat = 0;
        $modelKelima = 0;
        $data = collect();

        // =====================================
        // 1. WEB KABUPATEN (Admin)
        // =====================================
        if (Auth::guard('web')->check()) {
            $statusAdmin = ['Disetujui1', 'Disetujui2'];

            $modelPertama = DB::table('laporan_bidang_kesehatan')
                ->leftJoin(
                    'users_mobile',
                    'laporan_bidang_kesehatan.id_user',
                    '=',
                    'users_mobile.id'
                )
                ->where(function ($query) {
                    // DESA
                    $query->where(function ($q) {
                        $q->where('users_mobile.id_role', 1)
                            ->whereIn(
                                'laporan_bidang_kesehatan.status',
                                ['Disetujui1','Disetujui2']
                            );
                    })
                        // MOBILE KECAMATAN
                        ->orWhere(function ($q) {
                            $q->where('users_mobile.id_role', 2)
                                ->whereIn(
                                    'laporan_bidang_kesehatan.status',
                                    ['Proses', 'proses', 'PROSES','Disetujui2']
                                );
                        });
                })
                ->count();

            $modelKedua = DB::table('laporan_kelestarian_lingkungan_hidup')
                ->leftJoin(
                    'users_mobile',
                    'laporan_kelestarian_lingkungan_hidup.id_user',
                    '=',
                    'users_mobile.id'
                )
                ->where(function ($query) {
                    // DESA
                    $query->where(function ($q) {
                        $q->where('users_mobile.id_role', 1)
                            ->whereIn(
                                'laporan_kelestarian_lingkungan_hidup.status',
                                ['Disetujui1','Disetujui2']
                            );
                    })
                        // MOBILE KECAMATAN
                        ->orWhere(function ($q) {
                            $q->where('users_mobile.id_role', 2)
                                ->whereIn(
                                    'laporan_kelestarian_lingkungan_hidup.status',
                                    ['Proses', 'proses', 'PROSES','Disetujui2']
                                );
                        });
                })
                ->count();

            $modelKetiga = DB::table('laporan_perencanaan_sehat')
                ->leftJoin(
                    'users_mobile',
                    'laporan_perencanaan_sehat.id_user',
                    '=',
                    'users_mobile.id'
                )
                ->where(function ($query) {
                    // DESA
                    $query->where(function ($q) {
                        $q->where('users_mobile.id_role', 1)
                            ->whereIn(
                                'laporan_perencanaan_sehat.status',
                                ['Disetujui1','Disetujui2']
                            );
                    })
                        // MOBILE KECAMATAN
                        ->orWhere(function ($q) {
                            $q->where('users_mobile.id_role', 2)
                                ->whereIn(
                                    'laporan_perencanaan_sehat.status',
                                    ['Proses', 'proses', 'PROSES', 'Disetujui2']
                                );
                        });
                })
                ->count();

            $modelKeempat = DB::table('laporan_kader_pokja4')
                ->leftJoin(
                    'users_mobile',
                    'laporan_kader_pokja4.id_user',
                    '=',
                    'users_mobile.id'
                )
                ->where(function ($query) {
                    // DESA
                    $query->where(function ($q) {
                        $q->where('users_mobile.id_role', 1)
                            ->whereIn(
                                'laporan_kader_pokja4.status',
                                ['Disetujui1','Disetujui2']
                            );
                    })
                        // MOBILE KECAMATAN
                        ->orWhere(function ($q) {
                            $q->where('users_mobile.id_role', 2)
                                ->whereIn(
                                    'laporan_kader_pokja4.status',
                                    ['Proses', 'proses', 'PROSES', 'Disetujui2']
                                );
                        });
                })
                ->count();

            $modelKelima = DB::table('rekap_desa_bulanan')
                ->leftJoin(
                    'users_mobile',
                    'rekap_desa_bulanan.id_user',
                    '=',
                    'users_mobile.id'
                )
                ->where(function ($query) {
                    // DESA
                    $query->where(function ($q) {
                        $q->where('users_mobile.id_role', 1)
                            ->whereIn(
                                'rekap_desa_bulanan.status',
                                ['Disetujui1','Disetujui2']
                            );
                    })
                        // MOBILE KECAMATAN
                        ->orWhere(function ($q) {
                            $q->where('users_mobile.id_role', 2)
                                ->whereIn(
                                    'rekap_desa_bulanan.status',
                                    ['Proses', 'proses', 'PROSES', 'Disetujui2']
                                );
                        });
                })
                ->count();
        }
        // =====================================
        // 2. PENGGUNA MOBILE (Kecamatan / Desa)
        // =====================================
        else if (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) {
                $statusKecamatan = ['Proses', 'Disetujui1'];

                $modelPertama = DB::table('laporan_bidang_kesehatan')
                    ->leftJoin('users_mobile', 'laporan_bidang_kesehatan.id_user', '=', 'users_mobile.id')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1)
                    ->whereIn('laporan_bidang_kesehatan.status', $statusKecamatan)
                    ->count();

                $modelKedua = DB::table('laporan_kelestarian_lingkungan_hidup')
                    ->leftJoin('users_mobile', 'laporan_kelestarian_lingkungan_hidup.id_user', '=', 'users_mobile.id')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1)
                    ->whereIn('laporan_kelestarian_lingkungan_hidup.status', $statusKecamatan)
                    ->count();

                $modelKetiga = DB::table('laporan_perencanaan_sehat')
                    ->leftJoin('users_mobile', 'laporan_perencanaan_sehat.id_user', '=', 'users_mobile.id')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1)
                    ->whereIn('laporan_perencanaan_sehat.status', $statusKecamatan)
                    ->count();
                $modelKeempat = DB::table('laporan_kader_pokja4')
                    ->leftJoin('users_mobile', 'laporan_kader_pokja4.id_user', '=', 'users_mobile.id')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1)
                    ->whereIn('laporan_kader_pokja4.status', $statusKecamatan
                    )
                    ->count();
                $modelKelima = DB::table('rekap_desa_bulanan')
                    ->leftJoin('users_mobile', 'rekap_desa_bulanan.id_user', '=', 'users_mobile.id')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1)
                    ->whereIn('rekap_desa_bulanan.status', $statusKecamatan)
                    ->count();
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
