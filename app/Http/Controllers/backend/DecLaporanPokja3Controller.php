<?php

namespace App\Http\Controllers\backend;

use App\Models\LaporanPokja3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DecLaporanPokja3Controller extends Controller
{
    public function index()
    {
        $data2 = collect();

        if (Auth::guard('web')->check()) {
            $data2 = DB::table('laporan_kader_pokja3')
                ->leftJoin('users_mobile', 'laporan_kader_pokja3.id_user', '=', 'users_mobile.id')
                ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('laporan_kader_pokja3.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                ->whereIn('laporan_kader_pokja3.status', ['Disetujui2', 'disetujui2', 'DISETUJUI2'])
                ->orderBy('id_kader_pokja3', 'desc')
                ->get();
        } elseif (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) { // Kecamatan
                $data2 = DB::table('laporan_kader_pokja3')
                    ->leftJoin('users_mobile', 'laporan_kader_pokja3.id_user', '=', 'users_mobile.id')
                    ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('laporan_kader_pokja3.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1)
                    ->whereIn('laporan_kader_pokja3.status', ['Disetujui1', 'disetujui1', 'DISETUJUI1'])
                    ->orderBy('id_kader_pokja3', 'desc')
                    ->get();
            }
        }

        return view('backend.declaporanpokja3', compact('data2'));
    }

    public function destroy(string $id_kader_pokja3)
    {
        $data2 = LaporanPokja3::find($id_kader_pokja3);
        if ($data2) {
            $data2->delete();
            return redirect()->route('declaporanpokja3.index')->with(['success' => 'Berhasil Menghapus Laporan']);
        }
        return redirect()->route('declaporanpokja3.index')->with(['error' => 'Data tidak ditemukan']);
    }
}