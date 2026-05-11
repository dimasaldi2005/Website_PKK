<?php

namespace App\Http\Controllers\backend;

use App\Models\KelestarianLingkunganHidup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KelestarianLingkunganHidupController extends Controller
{
    public function index()
    {
        $data = collect();

        if (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            $query = DB::table('laporan_kelestarian_lingkungan_hidup')
                ->leftJoin('users_mobile', 'laporan_kelestarian_lingkungan_hidup.id_user', '=', 'users_mobile.id')
                ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                ->select(
                    'laporan_kelestarian_lingkungan_hidup.*',
                    'subdistrict.name as nama_kec',
                    'village.name as nama_desa'
                )
                ->whereIn('laporan_kelestarian_lingkungan_hidup.status', ['Proses', 'proses'])
                ->orderBy('laporan_kelestarian_lingkungan_hidup.id_pokja4_bidang2', 'desc');

            if ($user->id_role == 2) {
                // Kecamatan melihat data desa-desanya
                $query->where('users_mobile.id_subdistrict', $user->id_subdistrict);
            } else {
                // Desa melihat datanya sendiri
                $query->where('laporan_kelestarian_lingkungan_hidup.id_user', $user->id);
            }

            $data = $query->get();

        } else {
            // Admin web
            // FIX: Admin bisa melihat data Proses dan Disetujui1
            $data = DB::table('laporan_kelestarian_lingkungan_hidup')
                ->leftJoin('users_mobile', 'laporan_kelestarian_lingkungan_hidup.id_user', '=', 'users_mobile.id')
                ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                ->select(
                    'laporan_kelestarian_lingkungan_hidup.*',
                    'subdistrict.name as nama_kec',
                    'village.name as nama_desa'
                )
                ->whereIn('laporan_kelestarian_lingkungan_hidup.status', ['Proses', 'proses', 'Disetujui1'])
                ->orderBy('laporan_kelestarian_lingkungan_hidup.id_pokja4_bidang2', 'desc')
                ->get();
        }

        return view('backend.kelestarian_lingkungan_hidup', compact('data'));
    }

    public function edit(string $id_pokja4_bidang2)
    {
        // FIX: Pakai where()->first() bukan find()
        $data = KelestarianLingkunganHidup::where('id_pokja4_bidang2', $id_pokja4_bidang2)->first();
        return view('backend.tampil_kelestarian_lingkungan_hidup', compact('data'));
    }

    public function update(Request $request, string $id_pokja4_bidang2)
    {
        $data = KelestarianLingkunganHidup::where('id_pokja4_bidang2', $id_pokja4_bidang2)->first();
        if(!$data) return redirect()->back()->with('error', 'Data tidak ditemukan');

        $status = $request->status;
        if ($status == 'Disetujui' || $status == 'disetujui') {
            $status = Auth::guard('web')->check() ? 'Disetujui2' : 'Disetujui1';
        }

        $data->update([
            'jamban' => $request->jamban,
            'spal' => $request->spal,
            'tps' => $request->tps,
            'mck' => $request->mck,
            'pdam' => $request->pdam,
            'sumur' => $request->sumur,
            'dll' => $request->dll,
            'status' => $status,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('kelestarian_lingkungan_hidup.index')
            ->with(['success' => 'Berhasil Mengubah Status']);
    }

    public function destroy(string $id_pokja4_bidang2)
    {
        $data = KelestarianLingkunganHidup::where('id_pokja4_bidang2', $id_pokja4_bidang2)->first();
        if($data) {
            $data->delete();
        }
        return redirect()->route('kelestarian_lingkungan_hidup.index')
            ->with(['success' => 'Berhasil Menghapus Laporan']);
    }
}