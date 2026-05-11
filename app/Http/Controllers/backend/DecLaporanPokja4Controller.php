<?php

namespace App\Http\Controllers\backend;

use App\Models\LaporanPokja4;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DecLaporanPokja4Controller extends Controller
{
    public function index()
    {
        $data2 = collect();

        if (Auth::guard('web')->check()) {
            // Admin web
            $data2 = DB::table('laporan_kader_pokja4')
                ->join('users_mobile', 'laporan_kader_pokja4.id_user', '=', 'users_mobile.id')
                ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->join('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('laporan_kader_pokja4.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                ->where('laporan_kader_pokja4.status', 'Disetujui2')
                ->orderBy('id_kader_pokja4', 'desc')
                ->get();

        } elseif (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) {
                // Kecamatan
                $data2 = DB::table('laporan_kader_pokja4')
                    ->join('users_mobile', 'laporan_kader_pokja4.id_user', '=', 'users_mobile.id')
                    ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->join('village', 'users_mobile.id_village', '=', 'village.id')
                    ->where('users_mobile.id_role', 1) 
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict) 
                    ->where('laporan_kader_pokja4.status', 'Disetujui1')
                    ->select('laporan_kader_pokja4.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->orderBy('id_kader_pokja4', 'desc')
                    ->get();
            }
        }

        return view('backend.declaporanpokja4', compact('data2'));
    }

    public function destroy(string $id_kader_pokja4)
    {
        // FIX: Hapus berdasarkan primary key yang benar
        $data2 = LaporanPokja4::where('id_kader_pokja4', $id_kader_pokja4)->first();

        if (!$data2) {
            return redirect()->route('declaporanpokja4.index')->with(['error' => 'Data tidak ditemukan']);
        }

        $data2->delete();

        return redirect()->route('declaporanpokja4.index')->with(['success' => 'Berhasil Menghapus Laporan']);
    }
}