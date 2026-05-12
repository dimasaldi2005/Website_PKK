<?php

namespace App\Http\Controllers\backend;

use App\Models\Pendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DecPendidikanController extends Controller
{
    public function index()
    {
        $data2 = collect();

        // =====================================
        // 1. JIKA YANG LOGIN ADMIN WEB (KABUPATEN)
        // =====================================
        if (Auth::guard('web')->check()) {
            // Admin Kabupaten harus bisa lihat yang sudah di-ACC Kecamatan (1) DAN yang sudah Final (2)
            $statusAdmin = ['Disetujui1', 'disetujui1', 'DISETUJUI1', 'Disetujui2', 'disetujui2', 'DISETUJUI2'];

            $data2 = DB::table('laporan_pendidikan_n_keterampilan')
                ->leftJoin('users_mobile', 'laporan_pendidikan_n_keterampilan.id_user', '=', 'users_mobile.id')
                ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('laporan_pendidikan_n_keterampilan.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                ->whereIn('laporan_pendidikan_n_keterampilan.status', $statusAdmin)
                ->orderBy('laporan_pendidikan_n_keterampilan.id_pokja2_bidang1', 'desc')
                ->get();
        } 
        // =====================================
        // 2. JIKA YANG LOGIN PENGGUNA MOBILE (KECAMATAN / DESA)
        // =====================================
        else if (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) { // Role Kecamatan
                // Kecamatan melihat data di wilayahnya yang sudah di-ACC (1) maupun yang sudah Final (2)
                $statusKec = ['Disetujui1', 'disetujui1', 'DISETUJUI1', 'Disetujui2', 'disetujui2', 'DISETUJUI2'];

                $data2 = DB::table('laporan_pendidikan_n_keterampilan')
                    ->leftJoin('users_mobile', 'laporan_pendidikan_n_keterampilan.id_user', '=', 'users_mobile.id')
                    ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('laporan_pendidikan_n_keterampilan.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->whereIn('laporan_pendidikan_n_keterampilan.status', $statusKec)
                    ->orderBy('laporan_pendidikan_n_keterampilan.id_pokja2_bidang1', 'desc')
                    ->get();
            } else { // Role Desa
                // Desa melihat semua riwayat laporannya sendiri
                $data2 = DB::table('laporan_pendidikan_n_keterampilan')
                    ->leftJoin('users_mobile', 'laporan_pendidikan_n_keterampilan.id_user', '=', 'users_mobile.id')
                    ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('laporan_pendidikan_n_keterampilan.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->where('laporan_pendidikan_n_keterampilan.id_user', $user->id)
                    ->orderBy('laporan_pendidikan_n_keterampilan.id_pokja2_bidang1', 'desc')
                    ->get();
            }
        }

        return view('backend.decpendidikan', compact('data2'));
    }

    public function destroy(string $id_pokja2_bidang1)
    {
        // Pastikan nama Primary Key di Model Pendidikan sesuai dengan id_pokja2_bidang1
        $data2 = Pendidikan::find($id_pokja2_bidang1);

        if ($data2) {
            // Hanya Admin web atau pemilik data (opsional) yang bisa menghapus
            if (Auth::guard('web')->check()) {
                $data2->delete();
                return redirect()->route('decpendidikan.index')->with(['success' => 'Berhasil Menghapus Laporan']);
            } else {
                abort(403, 'Anda tidak memiliki akses untuk menghapus data ini.');
            }
        }

        return redirect()->route('decpendidikan.index')->with(['error' => 'Data tidak ditemukan']);
    }
}