<?php

namespace App\Http\Controllers\backend;

use App\Models\Kesehatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DecKesehatanController extends Controller
{
    public function index()
    {
        $data2 = collect(); // Default data kosong agar tidak error jika guest

        if (Auth::guard('web')->check()) {
            // Admin Web melihat data yang Disetujui2
            $data2 = DB::table('laporan_bidang_kesehatan')
                ->join('users_mobile', 'laporan_bidang_kesehatan.id_user', '=', 'users_mobile.id')
                ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->join('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('laporan_bidang_kesehatan.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                ->where('laporan_bidang_kesehatan.status', 'Disetujui2')
                ->orderBy('id_pokja4_bidang1', 'desc')
                ->get();
        } elseif (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) {
                // Kecamatan melihat data desa yang Disetujui1
                $data2 = DB::table('laporan_bidang_kesehatan')
                    ->join('users_mobile', 'laporan_bidang_kesehatan.id_user', '=', 'users_mobile.id')
                    ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->join('village', 'users_mobile.id_village', '=', 'village.id')
                    ->where('users_mobile.id_role', 1) 
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict) 
                    ->where('laporan_bidang_kesehatan.status', 'Disetujui1')
                    ->select('laporan_bidang_kesehatan.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->orderBy('id_pokja4_bidang1', 'desc')
                    ->get();
            }
        }

        return view('backend.deckesehatan', compact('data2'));
    }

    public function destroy(string $id_pokja4_bidang1)
    {
        // Menggunakan primary key spesifik jika find() gagal
        $data2 = Kesehatan::where('id_pokja4_bidang1', $id_pokja4_bidang1)->first();
        if ($data2) {
            $data2->delete();
            return redirect()->route('deckesehatan.index')->with(['success' => 'Berhasil Menghapus Laporan']);
        }
        return redirect()->route('deckesehatan.index')->with(['error' => 'Data tidak ditemukan']);
    }
}