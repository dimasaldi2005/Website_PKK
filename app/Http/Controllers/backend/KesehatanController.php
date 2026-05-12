<?php

namespace App\Http\Controllers\backend;

use Carbon\Carbon;
use App\Models\Kesehatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KesehatanController extends Controller
{
    public function index()
    {
        $data = collect();

        if (Auth::guard('web')->check()) {
            // ADMIN: Hanya lihat yang antre (Disetujui1)
            $data = DB::table('laporan_bidang_kesehatan')
                ->join('users_mobile', 'laporan_bidang_kesehatan.id_user', '=', 'users_mobile.id')
                ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->join('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('laporan_bidang_kesehatan.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                ->where('laporan_bidang_kesehatan.status', 'Disetujui1')
                ->orderBy('id_pokja4_bidang1', 'desc')->get();
        } elseif (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();
            $query = DB::table('laporan_bidang_kesehatan')
                ->join('users_mobile', 'laporan_bidang_kesehatan.id_user', '=', 'users_mobile.id')
                ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->join('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('laporan_bidang_kesehatan.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                ->orderBy('id_pokja4_bidang1', 'desc');

            if ($user->id_role == 2) {
                // KECAMATAN: Hanya lihat Proses
                $data = $query->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                              ->where('laporan_bidang_kesehatan.status', 'Proses')->get();
            } else {
                // DESA: Lihat milik sendiri
                $data = $query->where('laporan_bidang_kesehatan.id_user', $user->id)->get();
            }
        }

        return view('backend.kesehatan', compact('data'));
    }

    public function edit($id)
    {
        $data = Kesehatan::where('id_pokja4_bidang1', $id)->firstOrFail();
        return view('backend.tampil_kesehatan', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Kesehatan::where('id_pokja4_bidang1', $id)->firstOrFail();
        $status = $request->status;

        if (in_array(strtolower($status), ['disetujui', 'disetujui1', 'disetujui2'])) {
            $status = Auth::guard('web')->check() ? 'Disetujui2' : 'Disetujui1';
        }

        $data->update([
            'jumlah_posyandu' => $request->jumlah_posyandu ?? $data->jumlah_posyandu,
            'jumlah_posyandu_iterasi' => $request->jumlah_posyandu_iterasi ?? $data->jumlah_posyandu_iterasi,
            'jumlah_klp' => $request->jumlah_klp ?? $data->jumlah_klp,
            'jumlah_anggota' => $request->jumlah_anggota ?? $data->jumlah_anggota,
            'jumlah_kartu_gratis' => $request->jumlah_kartu_gratis ?? $data->jumlah_kartu_gratis,
            'status' => $status,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('kesehatan.index')->with('success', 'Berhasil Mengubah Status');
    }

    public function destroy($id)
    {
        Kesehatan::where('id_pokja4_bidang1', $id)->delete();
        return redirect()->route('kesehatan.index')->with('success', 'Laporan Berhasil Dihapus');
    }
}