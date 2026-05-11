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
            // Admin web
            $data2 = DB::table('laporan_perencanaan_sehat')
                ->join('users_mobile', 'laporan_perencanaan_sehat.id_user', '=', 'users_mobile.id')
                ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->join('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('laporan_perencanaan_sehat.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                ->where('laporan_perencanaan_sehat.status', 'Disetujui2')
                ->orderBy('id_pokja4_bidang3', 'desc')
                ->get();
        } elseif (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) {
                // Kecamatan
                $data2 = DB::table('laporan_perencanaan_sehat')
                    ->join('users_mobile', 'laporan_perencanaan_sehat.id_user', '=', 'users_mobile.id')
                    ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->join('village', 'users_mobile.id_village', '=', 'village.id')
                    ->where('users_mobile.id_role', 1) 
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict) 
                    ->where('laporan_perencanaan_sehat.status', 'Disetujui1')
                    ->select('laporan_perencanaan_sehat.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->orderBy('id_pokja4_bidang3', 'desc')
                    ->get();
            }
        }

        return view('backend.decperencanaan', compact('data2'));
    }

    public function destroy(string $id_pokja4_bidang3)
    {
        // FIX: Hapus find() diganti where()->first()
        $data2 = PerencanaanSehat::where('id_pokja4_bidang3', $id_pokja4_bidang3)->first();

        if (!$data2) {
            return redirect()->route('decperencanaan.index')->with(['error' => 'Data tidak ditemukan']);
        }

        $data2->delete();
        return redirect()->route('decperencanaan.index')->with(['success' => 'Berhasil Menghapus Laporan']);
    }
}