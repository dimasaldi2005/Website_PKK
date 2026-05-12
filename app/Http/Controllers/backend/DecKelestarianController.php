<?php

namespace App\Http\Controllers\backend;

use App\Models\KelestarianLingkunganHidup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DecKelestarianController extends Controller
{
    public function index()
    {
        $data2 = collect();

        if (Auth::guard('web')->check()) {
            // ADMIN: Lihat yang sudah Final (Disetujui2)
            $data2 = DB::table('laporan_kelestarian_lingkungan_hidup')
                ->join('users_mobile', 'laporan_kelestarian_lingkungan_hidup.id_user', '=', 'users_mobile.id')
                ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->join('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('laporan_kelestarian_lingkungan_hidup.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                ->where('laporan_kelestarian_lingkungan_hidup.status', 'Disetujui2')
                ->orderBy('id_pokja4_bidang2', 'desc')->get();
        } elseif (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();
            if ($user->id_role == 2) {
                // KECAMATAN: Lihat yang sudah mereka ACC (Disetujui1)
                $data2 = DB::table('laporan_kelestarian_lingkungan_hidup')
                    ->join('users_mobile', 'laporan_kelestarian_lingkungan_hidup.id_user', '=', 'users_mobile.id')
                    ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->join('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('laporan_kelestarian_lingkungan_hidup.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('laporan_kelestarian_lingkungan_hidup.status', 'Disetujui1')
                    ->orderBy('id_pokja4_bidang2', 'desc')->get();
            } else {
                // DESA: Lihat milik sendiri yang sudah di-ACC
                $data2 = DB::table('laporan_kelestarian_lingkungan_hidup')
                    ->join('users_mobile', 'laporan_kelestarian_lingkungan_hidup.id_user', '=', 'users_mobile.id')
                    ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->join('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('laporan_kelestarian_lingkungan_hidup.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->where('laporan_kelestarian_lingkungan_hidup.id_user', $user->id)
                    ->whereIn('laporan_kelestarian_lingkungan_hidup.status', ['Disetujui1', 'Disetujui2'])
                    ->orderBy('id_pokja4_bidang2', 'desc')->get();
            }
        }

        return view('backend.deckelestarian', compact('data2'));
    }

    public function destroy(string $id_pokja4_bidang2)
    {
        KelestarianLingkunganHidup::where('id_pokja4_bidang2', $id_pokja4_bidang2)->delete();
        return redirect()->route('deckelestarian.index')->with(['success' => 'Riwayat Berhasil Dihapus']);
    }
}