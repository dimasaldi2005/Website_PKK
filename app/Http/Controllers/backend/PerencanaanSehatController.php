<?php

namespace App\Http\Controllers\backend;

use App\Models\PerencanaanSehat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PerencanaanSehatController extends Controller
{
    public function index()
    {
        $data = collect();

        if (Auth::guard('web')->check()) {
            // ADMIN: Hanya lihat yang Disetujui1
            $data = DB::table('laporan_perencanaan_sehat')
                ->join('users_mobile', 'laporan_perencanaan_sehat.id_user', '=', 'users_mobile.id')
                ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->join('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('laporan_perencanaan_sehat.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                ->where('laporan_perencanaan_sehat.status', 'Disetujui1')
                ->orderBy('id_pokja4_bidang3', 'desc')
                ->get();
        } elseif (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();
            $query = DB::table('laporan_perencanaan_sehat')
                ->join('users_mobile', 'laporan_perencanaan_sehat.id_user', '=', 'users_mobile.id')
                ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->join('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('laporan_perencanaan_sehat.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                ->orderBy('id_pokja4_bidang3', 'desc');

            if ($user->id_role == 2) {
                // KECAMATAN: Hanya lihat Proses
                $data = $query->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                              ->where('laporan_perencanaan_sehat.status', 'Proses')->get();
            } else {
                // DESA: Lihat milik sendiri
                $data = $query->where('laporan_perencanaan_sehat.id_user', $user->id)->get();
            }
        }

        return view('backend.perencanaan_sehat', compact('data'));
    }

    public function edit($id)
    {
        $data = PerencanaanSehat::where('id_pokja4_bidang3', $id)->firstOrFail();
        return view('backend.tampil_perencanaan_sehat', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = PerencanaanSehat::where('id_pokja4_bidang3', $id)->firstOrFail();
        $status = $request->status;
        if (strtolower($status) == 'disetujui') {
            $status = Auth::guard('web')->check() ? 'Disetujui2' : 'Disetujui1';
        }

        $data->update([
            'J_Psubur' => $request->J_Psubur ?? $data->J_Psubur,
            'J_Wsubur' => $request->J_Wsubur ?? $data->J_Wsubur,
            'Kb_p' => $request->Kb_p ?? $data->Kb_p,
            'Kb_w' => $request->Kb_w ?? $data->Kb_w,
            'Kk_tbg' => $request->Kk_tbg ?? $data->Kk_tbg,
            'status' => $status,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('perencanaan_sehat.index')->with(['success' => 'Status Berhasil Diperbarui']);
    }

    public function destroy($id)
    {
        PerencanaanSehat::where('id_pokja4_bidang3', $id)->delete();
        return redirect()->route('perencanaan_sehat.index')->with(['success' => 'Laporan Berhasil Dihapus']);
    }
}