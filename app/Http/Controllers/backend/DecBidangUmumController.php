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
        $data2 = collect();

        if (Auth::guard('web')->check()) {
            // ADMIN: Lihat yang sudah Final (Disetujui2)
            $data2 = DB::table('laporan_umum')
                ->join('users_mobile', 'laporan_umum.id_user', '=', 'users_mobile.id')
                ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->join('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('laporan_umum.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                ->where('laporan_umum.status', 'Disetujui2')
                ->orderBy('id_laporan_umum', 'desc')->get();
        } elseif (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();
            if ($user->id_role == 2) { // KECAMATAN: Lihat yang sudah mereka ACC
                $data2 = DB::table('laporan_umum')
                    ->join('users_mobile', 'laporan_umum.id_user', '=', 'users_mobile.id')
                    ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->join('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('laporan_umum.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('laporan_umum.status', 'Disetujui1')
                    ->orderBy('id_laporan_umum', 'desc')->get();
            } else { // DESA: Lihat riwayat sendiri
                $data2 = DB::table('laporan_umum')
                    ->join('users_mobile', 'laporan_umum.id_user', '=', 'users_mobile.id')
                    ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->join('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('laporan_umum.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->where('laporan_umum.id_user', $user->id)
                    ->whereIn('laporan_umum.status', ['Disetujui1', 'Disetujui2'])
                    ->orderBy('id_laporan_umum', 'desc')->get();
            }
        }

        return view('backend.decbidangumum', compact('data2'));
    }

    public function destroy($id)
    {
        BidangUmum::where('id_laporan_umum', $id)->delete();
        return redirect()->route('decbidangumum.index')->with('success', 'Riwayat Berhasil Dihapus');
    }
}