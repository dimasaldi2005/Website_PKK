<?php

namespace App\Http\Controllers\backend;

use App\Models\BidangUmum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DecBidangUmumController extends Controller
{
    public function index()
    {
        $data = collect(); 

        // =====================================
        // 1. WEB KABUPATEN (ADMIN)
        // =====================================
        if (Auth::guard('web')->check()) {
            $data = DB::table('laporan_umum')
                ->leftJoin('users_mobile', 'laporan_umum.id_user', '=', 'users_mobile.id')
                ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('laporan_umum.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                // KABUPATEN: Melihat yang sudah Final di-ACC Admin
                ->whereIn('laporan_umum.status', ['Disetujui2', 'disetujui2', 'DISETUJUI2'])
                ->orderBy('id_laporan_umum', 'desc')
                ->get();
        } 
        
        // =====================================
        // 2. PENGGUNA MOBILE (KECAMATAN / DESA)
        // =====================================
        elseif (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) { 
                // --- KECAMATAN ---
                // JURUS ANTI-0: Hapus filter role 1 agar tidak macet
                $data = DB::table('laporan_umum')
                    ->leftJoin('users_mobile', 'laporan_umum.id_user', '=', 'users_mobile.id')
                    ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('laporan_umum.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    // KECAMATAN: Melihat yang sudah mereka ACC (Disetujui1) maupun yang sudah Final (Disetujui2)
                    ->whereIn('laporan_umum.status', ['Disetujui1', 'disetujui1', 'DISETUJUI1', 'Disetujui2', 'disetujui2', 'DISETUJUI2'])
                    ->orderBy('id_laporan_umum', 'desc')
                    ->get();
            } else {
                // --- DESA ---
                // DESA: Melihat riwayat miliknya sendiri yang sudah diproses
                $data = DB::table('laporan_umum')
                    ->leftJoin('users_mobile', 'laporan_umum.id_user', '=', 'users_mobile.id')
                    ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('laporan_umum.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->where('laporan_umum.id_user', $user->id)
                    ->whereIn('laporan_umum.status', ['Disetujui1', 'Disetujui2'])
                    ->orderBy('id_laporan_umum', 'desc')
                    ->get();
            }
        }

        return view('backend.decbidangumum', compact('data'));
    }

    public function destroy(string $id_laporan_umum)
    {
        // Cari pakai ID yang spesifik
        $data = BidangUmum::where('id_laporan_umum', $id_laporan_umum)->first();
        
        if ($data) {
            $data->delete();
            return redirect()->route('decbidangumum.index')->with(['success' => 'Berhasil Menghapus Riwayat Laporan']);
        }
        
        return redirect()->route('decbidangumum.index')->with(['error' => 'Data tidak ditemukan']);
    }
}