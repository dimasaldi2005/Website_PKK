<?php

namespace App\Http\Controllers\backend;

use App\Models\LaporanPokja3;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LaporanPokja3Controller extends Controller
{
    public function index()
    {
        $data = collect();

        // 1. WEB KABUPATEN (ADMIN)
        if (Auth::guard('web')->check()) {
            $data = DB::table('laporan_kader_pokja3')
                ->join('users_mobile', 'laporan_kader_pokja3.id_user', '=', 'users_mobile.id')
                ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->join('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('laporan_kader_pokja3.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                // Hanya melihat yang sudah di-ACC Kecamatan (Disetujui1)
                ->where('laporan_kader_pokja3.status', 'Disetujui1')
                ->orderBy('laporan_kader_pokja3.id_kader_pokja3', 'desc')
                ->get();
        } 
        
        // 2. PENGGUNA MOBILE (KECAMATAN / DESA)
        else if (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();
            
            if ($user->id_role == 2) { // KECAMATAN
                $data = DB::table('laporan_kader_pokja3')
                    ->join('users_mobile', 'laporan_kader_pokja3.id_user', '=', 'users_mobile.id')
                    ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->join('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('laporan_kader_pokja3.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    // Hanya melihat laporan mentah (Proses)
                    ->where('laporan_kader_pokja3.status', 'Proses')
                    ->orderBy('laporan_kader_pokja3.id_kader_pokja3', 'desc')
                    ->get();
            } else {
                // DESA
                $data = DB::table('laporan_kader_pokja3')
                    ->join('users_mobile', 'laporan_kader_pokja3.id_user', '=', 'users_mobile.id')
                    ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->join('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('laporan_kader_pokja3.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->where('laporan_kader_pokja3.id_user', $user->id)
                    ->orderBy('laporan_kader_pokja3.id_kader_pokja3', 'desc')
                    ->get();
            }
        }

        return view('backend.laporanpokja3', compact('data'));
    }

    public function edit(string $id_kader_pokja3)
    {
        $data = LaporanPokja3::find($id_kader_pokja3);
        if (!$data) return redirect()->back()->with('error', 'Data tidak ditemukan!');
        return view('backend.tampil_laporanpokja3', compact('data'));
    }

    public function update(Request $request, string $id_kader_pokja3)
    {
        $data = LaporanPokja3::find($id_kader_pokja3);
        $status = $request->status;

        // Otomatis tentukan level ACC
        if (in_array(strtolower($status), ['disetujui', 'disetujui1', 'disetujui2'])) {
            $status = Auth::guard('pengguna')->check() ? 'Disetujui1' : 'Disetujui2';
        }

        $data->update([
            'pangan'             => $request->pangan ?? $data->pangan,
            'sandang'            => $request->sandang ?? $data->sandang,
            'tata_laksana_rumah' => $request->tata_laksana_rumah ?? $data->tata_laksana_rumah,
            'status'             => $status,
            'catatan'            => $request->catatan,
            'updated_at'         => now(),
        ]);

        return redirect()->route('laporanpokja3.index')->with(['success' => 'Status Berhasil Diperbarui']);
    }

    public function destroy(string $id_kader_pokja3)
    {
        $data = LaporanPokja3::find($id_kader_pokja3);
        if ($data) {
            $data->delete();
            return redirect()->route('laporanpokja3.index')->with(['success' => 'Laporan Berhasil Dihapus']);
        }
        return redirect()->route('laporanpokja3.index')->with(['error' => 'Data tidak ditemukan']);
    }
}