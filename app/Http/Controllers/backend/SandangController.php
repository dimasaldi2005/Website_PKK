<?php

namespace App\Http\Controllers\backend;

use App\Models\Sandang;
use App\Models\Pengguna; // Tambahan untuk lookup edit
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SandangController extends Controller
{
    public function index()
    {
        $data = collect();

        // 1. JIKA YANG LOGIN PENGGUNA MOBILE (KECAMATAN)
        if (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) { // Role Kecamatan
                $data = DB::table('laporan_sandang')
                    ->leftJoin('users_mobile', 'laporan_sandang.id_user', '=', 'users_mobile.id')
                    ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('laporan_sandang.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1) // Desa role
                    ->whereIn('laporan_sandang.status', ['proses', 'Proses', 'PROSES'])
                    ->orderBy('laporan_sandang.id_pokja3_bidang2', 'desc')
                    ->get();
            }
        } 
        // 2. JIKA YANG LOGIN ADMIN WEB
        else if (Auth::guard('web')->check()) {
            $data = DB::table('laporan_sandang')
                ->leftJoin('users_mobile', 'laporan_sandang.id_user', '=', 'users_mobile.id')
                ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('laporan_sandang.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                // Tampilkan Disetujui1 dan Proses agar Admin bisa memantau
                ->whereIn('laporan_sandang.status', ['Disetujui1', 'disetujui1', 'DISETUJUI1', 'proses', 'Proses', 'PROSES'])
                ->orderBy('laporan_sandang.id_pokja3_bidang2', 'desc')
                ->get();
        }

        return view('backend.sandang', compact('data'));
    }

    public function edit(string $id_pokja3_bidang2)
    {
        $data = Sandang::find($id_pokja3_bidang2);
        
        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }

        $user = Pengguna::find($data->id_user);
        $kecamatan = $user ? DB::table('subdistrict')->where('id', $user->id_subdistrict)->first() : null;
        $desa = $user ? DB::table('village')->where('id', $user->id_village)->first() : null;

        // Pass variabel kecamatan dan desa (seperti controller lain) jika dibutuhkan di view
        return view('backend.tampil_sandang', compact('data', 'kecamatan', 'desa'));
    }

    public function update(Request $request, string $id_pokja3_bidang2)
    {
        $data = Sandang::find($id_pokja3_bidang2);

        // Tentukan status persetujuan
        $status = $request->status;
        if (strtolower($status) == 'disetujui') {
            $status = Auth::guard('pengguna')->check() ? 'Disetujui1' : 'Disetujui2';
        }

        // Pakai ?? agar data angka tidak menjadi NULL jika form approval tidak mengirim nilai
        $data->update([
            'pangan'     => $request->pangan ?? $data->pangan,
            'sandang'    => $request->sandang ?? $data->sandang,
            'jasa'       => $request->jasa ?? $data->jasa,
            'status'     => $status,
            'catatan'    => $request->catatan,
            'updated_at' => now(),
        ]);

        return redirect()->route('sandang.index')->with(['success' => 'Berhasil Mengubah Status']);
    }

    public function destroy(string $id_pokja3_bidang2)
    {
        $data = Sandang::find($id_pokja3_bidang2);
        if ($data) {
            $data->delete();
            return redirect()->route('sandang.index')->with(['success' => 'Berhasil Menghapus Laporan']);
        }
        return redirect()->route('sandang.index')->with(['error' => 'Data tidak ditemukan']);
    }
}