<?php

namespace App\Http\Controllers\backend;

use App\Models\Perumahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DecPerumahanController extends Controller
{
    public function index()
    {
        $data2 = collect();

        // =====================================
        // 1. WEB KABUPATEN (Lihat Riwayat Final)
        // =====================================
        if (Auth::guard('web')->check()) {
            $data2 = DB::table('laporan_perumahan')
                ->leftJoin('users_mobile', 'laporan_perumahan.id_user', '=', 'users_mobile.id')
                ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('laporan_perumahan.*', 'village.name as nama_desa', 'subdistrict.name as nama_kec')
                // KABUPATEN: Hanya melihat yang sudah selesai di-ACC Admin (Final)
                ->whereIn('laporan_perumahan.status', ['Disetujui2', 'disetujui2', 'DISETUJUI2'])
                ->orderBy('id_pokja3_bidang3', 'desc')
                ->get();
        } 
        
        // =====================================
        // 2. PENGGUNA MOBILE (KECAMATAN / DESA)
        // =====================================
        elseif (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) { // KECAMATAN
                $data2 = DB::table('laporan_perumahan')
                    ->leftJoin('users_mobile', 'laporan_perumahan.id_user', '=', 'users_mobile.id')
                    ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('laporan_perumahan.*', 'village.name as nama_desa', 'subdistrict.name as nama_kec')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    // KECAMATAN: Melihat riwayat yang sudah mereka ACC (Disetujui1)
                    ->whereIn('laporan_perumahan.status', ['Disetujui1', 'disetujui1', 'DISETUJUI1'])
                    ->orderBy('id_pokja3_bidang3', 'desc')
                    ->get();
            } else {
                // DESA: Melihat data laporannya sendiri yang sudah di-ACC
                $data2 = DB::table('laporan_perumahan')
                    ->leftJoin('users_mobile', 'laporan_perumahan.id_user', '=', 'users_mobile.id')
                    ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('laporan_perumahan.*', 'village.name as nama_desa', 'subdistrict.name as nama_kec')
                    ->where('laporan_perumahan.id_user', $user->id)
                    ->whereIn('laporan_perumahan.status', ['Disetujui1', 'Disetujui2'])
                    ->orderBy('id_pokja3_bidang3', 'desc')
                    ->get();
            }
        }

        return view('backend.decperumahan', compact('data2'));
    }

    public function destroy(string $id_pokja3_bidang3)
    {
        $data2 = Perumahan::find($id_pokja3_bidang3);
        if ($data2) {
            $data2->delete();
            return redirect()->route('decperumahan.index')->with(['success' => 'Berhasil Menghapus Riwayat Laporan']);
        }
        return redirect()->route('decperumahan.index')->with(['error' => 'Data tidak ditemukan']);
    }
}