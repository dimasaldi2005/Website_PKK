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

        if (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            $query = DB::table('laporan_perencanaan_sehat')
                ->leftJoin('users_mobile', 'laporan_perencanaan_sehat.id_user', '=', 'users_mobile.id')
                ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                ->select(
                    'laporan_perencanaan_sehat.*',
                    'subdistrict.name as nama_kec',
                    'village.name as nama_desa'
                )
                ->whereIn('laporan_perencanaan_sehat.status', ['Proses', 'proses'])
                ->orderBy('laporan_perencanaan_sehat.id_pokja4_bidang3', 'desc');

            if ($user->id_role == 2) {
                // Kecamatan melihat data desa
                $query->where('users_mobile.id_subdistrict', $user->id_subdistrict);
            } else {
                // Desa melihat datanya sendiri
                $query->where('laporan_perencanaan_sehat.id_user', $user->id);
            }

            $data = $query->get();

        } else {
            // FIX: Admin web diizinkan melihat data Proses & Disetujui1
            $data = DB::table('laporan_perencanaan_sehat')
                ->leftJoin('users_mobile', 'laporan_perencanaan_sehat.id_user', '=', 'users_mobile.id')
                ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                ->select(
                    'laporan_perencanaan_sehat.*',
                    'subdistrict.name as nama_kec',
                    'village.name as nama_desa'
                )
                ->whereIn('laporan_perencanaan_sehat.status', ['Proses', 'proses', 'Disetujui1'])
                ->orderBy('laporan_perencanaan_sehat.id_pokja4_bidang3', 'desc')
                ->get();
        }

        return view('backend.perencanaan_sehat', compact('data'));
    }

    public function edit(string $id_pokja4_bidang3)
    {
        // FIX: Hapus find() diganti where()->first()
        $data = PerencanaanSehat::where('id_pokja4_bidang3', $id_pokja4_bidang3)->first();
        return view('backend.tampil_perencanaan_sehat', compact('data'));
    }

    public function update(Request $request, string $id_pokja4_bidang3)
    {
        $data = PerencanaanSehat::where('id_pokja4_bidang3', $id_pokja4_bidang3)->first();
        if(!$data) return redirect()->back()->with('error', 'Data tidak ditemukan');

        $status = $request->status;
        if ($status == 'Disetujui' || $status == 'disetujui') {
            $status = Auth::guard('web')->check() ? 'Disetujui2' : 'Disetujui1';
        }

        $data->update([
            'J_Psubur' => $request->J_Psubur,
            'J_Wsubur' => $request->J_Wsubur,
            'Kb_p' => $request->Kb_p,
            'Kb_w' => $request->Kb_w,
            'Kk_tbg' => $request->Kk_tbg,
            'status' => $status,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('perencanaan_sehat.index')->with(['success' => 'Berhasil Mengubah Status']);
    }

    public function destroy(string $id_pokja4_bidang3)
    {
        $data = PerencanaanSehat::where('id_pokja4_bidang3', $id_pokja4_bidang3)->first();
        if($data) {
            $data->delete();
        }
        return redirect()->route('perencanaan_sehat.index')->with(['success' => 'Berhasil Menghapus Laporan']);
    }
}