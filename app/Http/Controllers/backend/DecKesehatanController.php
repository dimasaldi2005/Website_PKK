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
        $data2 = collect();

        if (Auth::guard('web')->check()) {
            // ADMIN: Lihat yang sudah Final (Disetujui2)
            $data2 = DB::table('laporan_bidang_kesehatan')
                ->join('users_mobile', 'laporan_bidang_kesehatan.id_user', '=', 'users_mobile.id')
                ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->join('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('laporan_bidang_kesehatan.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                ->where('laporan_bidang_kesehatan.status', 'Disetujui2')
                ->orderBy('id_pokja4_bidang1', 'desc')->get();
        } elseif (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();
            if ($user->id_role == 2) {
                // KECAMATAN: Lihat yang sudah mereka ACC (Disetujui1)
                $data2 = DB::table('laporan_bidang_kesehatan')
                    ->join('users_mobile', 'laporan_bidang_kesehatan.id_user', '=', 'users_mobile.id')
                    ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->join('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('laporan_bidang_kesehatan.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('laporan_bidang_kesehatan.status', 'Disetujui1')
                    ->orderBy('id_pokja4_bidang1', 'desc')->get();
            } else {
                // DESA: Lihat milik sendiri yang sudah di-ACC
                $data2 = DB::table('laporan_bidang_kesehatan')
                    ->join('users_mobile', 'laporan_bidang_kesehatan.id_user', '=', 'users_mobile.id')
                    ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->join('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('laporan_bidang_kesehatan.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->where('laporan_bidang_kesehatan.id_user', $user->id)
                    ->whereIn('laporan_bidang_kesehatan.status', ['Disetujui1', 'Disetujui2'])
                    ->orderBy('id_pokja4_bidang1', 'desc')->get();
            }
        }

        return view('backend.deckesehatan', compact('data2'));
    }

    public function destroy(string $id_pokja4_bidang1)
    {
        Kesehatan::where('id_pokja4_bidang1', $id_pokja4_bidang1)->delete();
        return redirect()->route('deckesehatan.index')->with(['success' => 'Riwayat Berhasil Dihapus']);
    }
}