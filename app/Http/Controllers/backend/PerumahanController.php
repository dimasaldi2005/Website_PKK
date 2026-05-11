<?php

namespace App\Http\Controllers\backend;

use App\Models\Perumahan;
use App\Models\Pengguna; // <-- Tambahan supaya tabel view bisa melacak desa
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PerumahanController extends Controller
{
    public function index()
    {
        $data = collect();

        // 1. JIKA YANG LOGIN PENGGUNA MOBILE (KECAMATAN)
        if (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) { // Kecamatan
                $data = DB::table('laporan_perumahan')
                    ->leftJoin('users_mobile', 'laporan_perumahan.id_user', '=', 'users_mobile.id')
                    ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('laporan_perumahan.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1) // Hanya desa
                    ->whereIn('laporan_perumahan.status', ['proses', 'Proses', 'PROSES'])
                    ->orderBy('laporan_perumahan.id_pokja3_bidang3', 'desc')
                    ->get();
            }
        } 
        // 2. JIKA YANG LOGIN ADMIN WEB
        else if (Auth::guard('web')->check()) {
            $data = DB::table('laporan_perumahan')
                ->leftJoin('users_mobile', 'laporan_perumahan.id_user', '=', 'users_mobile.id')
                ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('laporan_perumahan.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                // Menampilkan Disetujui1 dan proses
                ->whereIn('laporan_perumahan.status', ['Disetujui1', 'disetujui1', 'DISETUJUI1', 'proses', 'Proses', 'PROSES'])
                ->orderBy('laporan_perumahan.id_pokja3_bidang3', 'desc')
                ->get();
        }

        return view('backend.perumahan', compact('data'));
    }

    public function edit(string $id_pokja3_bidang3)
    {
        $data = Perumahan::find($id_pokja3_bidang3);
        
        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }

        $user = Pengguna::find($data->id_user);
        $kecamatan = $user ? DB::table('subdistrict')->where('id', $user->id_subdistrict)->first() : null;
        $desa = $user ? DB::table('village')->where('id', $user->id_village)->first() : null;

        return view('backend.tampil_perumahan', compact('data', 'kecamatan', 'desa'));
    }

public function update(Request $request, string $id_pokja3_bidang3)
    {
        $data = Perumahan::find($id_pokja3_bidang3);
        $status = $request->status;

        // JURUS ANTI ERROR: Tangkap semua kemungkinan teks 'disetujui' dari form
        $statusVariasi = ['disetujui', 'disetujui (admin)', 'disetujui1', 'disetujui2'];
        
        if (in_array(strtolower($status), $statusVariasi)) {
            // Otomatis ubah jadi Disetujui1 (Kecamatan) atau Disetujui2 (Admin Web)
            $status = Auth::guard('pengguna')->check() ? 'Disetujui1' : 'Disetujui2';
        }

        // Pakai ?? agar angka tidak menjadi null jika inputan form kosong
        $data->update([
            'layak_huni'  => $request->layak_huni ?? $data->layak_huni,
            'tidak_layak' => $request->tidak_layak ?? $data->tidak_layak,
            'status'      => $status,
            'catatan'     => $request->catatan,
            'updated_at'  => now(),
        ]);

        return redirect()->route('perumahan.index')->with(['success' => 'Berhasil Mengubah Status']);
    }

    public function destroy(string $id_pokja3_bidang3)
    {
        $data = Perumahan::find($id_pokja3_bidang3);
        
        if ($data) {
            $data->delete();
            return redirect()->route('perumahan.index')->with(['success' => 'Berhasil Menghapus Laporan']);
        }
        
        return redirect()->route('perumahan.index')->with(['error' => 'Data tidak ditemukan']);
    }
}