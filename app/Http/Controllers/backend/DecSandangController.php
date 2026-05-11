<?php

namespace App\Http\Controllers\backend;

use App\Models\Sandang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DecSandangController extends Controller
{
    public function index()
    {
        $data2 = collect();

        // 1. JIKA YANG LOGIN ADMIN WEB
        if (Auth::guard('web')->check()) {
            $data2 = DB::table('laporan_sandang')
                ->leftJoin('users_mobile', 'laporan_sandang.id_user', '=', 'users_mobile.id')
                ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('laporan_sandang.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                ->whereIn('laporan_sandang.status', ['Disetujui2', 'disetujui2', 'DISETUJUI2'])
                ->orderBy('id_pokja3_bidang2', 'desc')
                ->get();
        } 
        // 2. JIKA YANG LOGIN PENGGUNA MOBILE (KECAMATAN)
        elseif (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) { // Role Kecamatan
                $data2 = DB::table('laporan_sandang')
                    ->leftJoin('users_mobile', 'laporan_sandang.id_user', '=', 'users_mobile.id')
                    ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('laporan_sandang.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1) // Hanya desa
                    ->whereIn('laporan_sandang.status', ['Disetujui1', 'disetujui1', 'DISETUJUI1'])
                    ->orderBy('id_pokja3_bidang2', 'desc')
                    ->get();
            }
        }

        return view('backend.decsandang', compact('data2'));
    }

    public function destroy(string $id_pokja3_bidang2)
    {
        $data2 = Sandang::find($id_pokja3_bidang2);

        if ($data2) {
            $data2->delete();
            return redirect()->route('decsandang.index')->with(['success' => 'Berhasil Menghapus Laporan']);
        }

        return redirect()->route('decsandang.index')->with(['error' => 'Data tidak ditemukan']);
    }
}