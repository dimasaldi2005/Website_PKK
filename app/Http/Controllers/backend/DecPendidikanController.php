<?php

namespace App\Http\Controllers\backend;

use App\Models\Pendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DecPendidikanController extends Controller
{
    public function index()
    {
        $data2 = collect();

        // 1. JIKA YANG LOGIN PENGGUNA MOBILE (KECAMATAN)
        if (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) { // Role Kecamatan
                // Tampilkan data desa (role 1) di kecamatan tersebut yang Disetujui1
                $data2 = DB::table('laporan_pendidikan_n_keterampilan')
                    ->leftJoin('users_mobile', 'laporan_pendidikan_n_keterampilan.id_user', '=', 'users_mobile.id')
                    ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('laporan_pendidikan_n_keterampilan.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1) // Desa
                    ->whereIn('laporan_pendidikan_n_keterampilan.status', ['Disetujui1', 'disetujui1', 'DISETUJUI1'])
                    ->orderBy('laporan_pendidikan_n_keterampilan.id_pokja2_bidang1', 'desc')
                    ->get();
            }
        } 
        // 2. JIKA YANG LOGIN ADMIN WEB
        else if (Auth::guard('web')->check()) {
            // Jika guard web (admin), tampilkan semua data yang disetujui
            $data2 = DB::table('laporan_pendidikan_n_keterampilan')
                ->leftJoin('users_mobile', 'laporan_pendidikan_n_keterampilan.id_user', '=', 'users_mobile.id')
                ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('laporan_pendidikan_n_keterampilan.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                ->whereIn('laporan_pendidikan_n_keterampilan.status', ['Disetujui2', 'disetujui2', 'DISETUJUI2'])
                ->orderBy('laporan_pendidikan_n_keterampilan.id_pokja2_bidang1', 'desc')
                ->get();
        }

        return view('backend.decpendidikan', compact('data2'));
    }

    public function destroy(string $id_pokja2_bidang1)
    {
        $data2 = Pendidikan::find($id_pokja2_bidang1);

        if ($data2) {
            // Hanya Admin web yang bisa menghapus data yang sudah selesai disetujui (opsional keamanan)
            if (Auth::guard('web')->check()) {
                $data2->delete();
                return redirect()->route('decpendidikan.index')->with(['success' => 'Berhasil Menghapus Laporan']);
            } elseif (Auth::guard('pengguna')->check()) {
                abort(403, 'Unauthorized action.');
            }
        }

        return redirect()->route('decpendidikan.index')->with(['error' => 'Data tidak ditemukan']);
    }
}