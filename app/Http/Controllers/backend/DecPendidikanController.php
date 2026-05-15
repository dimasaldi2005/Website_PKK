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

        // Cek guard yang login
        if (Auth::guard('web')->check()) {
            // Jika admin web, tampilkan semua data yang sudah disetujui
            $data2 = DB::table('laporan_pendidikan_n_keterampilan')
                ->join('users_mobile', 'laporan_pendidikan_n_keterampilan.id_user', '=', 'users_mobile.id')
                ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->join('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('laporan_pendidikan_n_keterampilan.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                ->where('laporan_pendidikan_n_keterampilan.status', 'Disetujui2')
                ->orderBy('id_pokja2_bidang1', 'desc')
                ->get();
        } elseif (Auth::guard('pengguna')->check()) {
            // Jika pengguna mobile dengan role 2 (Kecamatan)
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) {
                // Ambil data desa (role 1) di kecamatan tersebut yang sudah Disetujui1
                $data2 = DB::table('laporan_pendidikan_n_keterampilan')
                    ->join('users_mobile', 'laporan_pendidikan_n_keterampilan.id_user', '=', 'users_mobile.id')
                    ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->join('village', 'users_mobile.id_village', '=', 'village.id')
                    ->where('users_mobile.id_role', 1) // Hanya desa
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict) // Kecamatan yang sama
                    ->where('laporan_pendidikan_n_keterampilan.status', 'Disetujui1')
                    ->select('laporan_pendidikan_n_keterampilan.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->orderBy('id_pokja2_bidang1', 'desc')
                    ->get();
            } else {
                // Jika bukan role 2, kembalikan data kosong
                $data2 = collect();
            }
        } else {
            // Jika tidak ada guard yang cocok, kembalikan data kosong
            $data2 = collect();
        }

        return view('backend.decpendidikan', compact('data2'));
    }

    public function destroy(string $id_pokja2_bidang1)
    {
        // Pastikan nama Primary Key di Model Pendidikan sesuai dengan id_pokja2_bidang1
        $data2 = Pendidikan::find($id_pokja2_bidang1);

        if ($data2) {
            // Hanya Admin web atau pemilik data (opsional) yang bisa menghapus
            if (Auth::guard('web')->check()) {
                $data2->delete();
                return redirect()->route('decpendidikan.index')->with(['success' => 'Berhasil Menghapus Laporan']);
            } else {
                abort(403, 'Anda tidak memiliki akses untuk menghapus data ini.');
            }
        }

        return redirect()->route('decpendidikan.index')->with(['error' => 'Data tidak ditemukan']);
    }
}
