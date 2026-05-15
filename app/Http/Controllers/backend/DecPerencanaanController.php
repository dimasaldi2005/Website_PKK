<?php

namespace App\Http\Controllers\backend;

use App\Models\PerencanaanSehat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DecPerencanaanController extends Controller
{
    public function index()
    {
        $data2 = collect();

        if (Auth::guard('web')->check()) {
            // ADMIN: Lihat yang sudah Final (Disetujui2)
            $data2 = DB::table('laporan_perencanaan_sehat')
                ->join('users_mobile', 'laporan_perencanaan_sehat.id_user', '=', 'users_mobile.id')
                ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->join('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('laporan_perencanaan_sehat.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                ->where('laporan_perencanaan_sehat.status', 'Disetujui2')
                ->orderBy('id_pokja4_bidang3', 'desc')->get();
        } elseif (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();
            if ($user->id_role == 2) {
                // KECAMATAN: Lihat yang sudah mereka ACC (Disetujui1)
                $data2 = DB::table('laporan_perencanaan_sehat')
                    ->join('users_mobile', 'laporan_perencanaan_sehat.id_user', '=', 'users_mobile.id')
                    ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->join('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('laporan_perencanaan_sehat.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('laporan_perencanaan_sehat.status', 'Disetujui1')
                    ->orderBy('id_pokja4_bidang3', 'desc')->get();
            } else {
                // DESA: Lihat riwayat miliknya yang sudah di-ACC
                $data2 = DB::table('laporan_perencanaan_sehat')
                    ->join('users_mobile', 'laporan_perencanaan_sehat.id_user', '=', 'users_mobile.id')
                    ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->join('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('laporan_perencanaan_sehat.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->where('laporan_perencanaan_sehat.id_user', $user->id)
                    ->whereIn('laporan_perencanaan_sehat.status', ['Disetujui1', 'Disetujui2'])
                    ->orderBy('id_pokja4_bidang3', 'desc')->get();
            }
        }

        return view('backend.decperencanaan', compact('data2'));
    }

    public function destroy($id)
    {
        PerencanaanSehat::where('id_pokja4_bidang3', $id)->delete();
        return redirect()->route('decperencanaan.index')->with(['success' => 'Riwayat Berhasil Dihapus']);
    }
}