<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DecLaporanPokja1Controller extends Controller
{
    public function index()
    {
        $data2 = collect();

        // 1. CEK KABUPATEN DULU
        if (Auth::guard('web')->check()) {
            $data2 = DB::table('laporan_kader_pokja1')
                ->leftJoin('users_mobile', 'laporan_kader_pokja1.id_user', '=', 'users_mobile.id')
                ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('laporan_kader_pokja1.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                ->whereIn('laporan_kader_pokja1.status', ['Disetujui2', 'disetujui2', 'DISETUJUI2'])
                ->orderBy('id_kader_pokja1', 'desc')
                ->get();
        } 
        // 2. CEK KECAMATAN
        elseif (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();
            if ($user->id_role == 2) {
                $data2 = DB::table('laporan_kader_pokja1')
                    ->leftJoin('users_mobile', 'laporan_kader_pokja1.id_user', '=', 'users_mobile.id')
                    ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('laporan_kader_pokja1.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->whereIn('laporan_kader_pokja1.status', ['Disetujui1', 'disetujui1', 'DISETUJUI1'])
                    ->orderBy('id_kader_pokja1', 'desc')
                    ->get();
            }
        }

        return view('backend.declaporanpokja1', compact('data2'));
    }

    public function destroy(string $id_kader_pokja1) { /* Kode asli */ }
}