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

        if (Auth::guard('web')->check()) {
            // ADMIN: Hanya lihat yang antre (Disetujui1)
            $data = DB::table('laporan_kelestarian_lingkungan_hidup')
                ->join('users_mobile', 'laporan_kelestarian_lingkungan_hidup.id_user', '=', 'users_mobile.id')
                ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->join('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('laporan_kelestarian_lingkungan_hidup.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                ->where('laporan_kelestarian_lingkungan_hidup.status', 'Disetujui1')
                ->orderBy('id_pokja4_bidang2', 'desc')->get();
        } elseif (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();
            $query = DB::table('laporan_kelestarian_lingkungan_hidup')
                ->join('users_mobile', 'laporan_kelestarian_lingkungan_hidup.id_user', '=', 'users_mobile.id')
                ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->join('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('laporan_kelestarian_lingkungan_hidup.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                ->orderBy('id_pokja4_bidang2', 'desc');

            if ($user->id_role == 2) {
                // KECAMATAN: Hanya lihat Proses
                $data = $query->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                              ->where('laporan_kelestarian_lingkungan_hidup.status', 'Proses')->get();
            } else {
                // DESA: Lihat milik sendiri
                $data = $query->where('laporan_kelestarian_lingkungan_hidup.id_user', $user->id)->get();
            }
        }

        return view('backend.kelestarian_lingkungan_hidup', compact('data'));
    }

    public function edit($id)
    {
        $data = KelestarianLingkunganHidup::where('id_pokja4_bidang2', $id)->firstOrFail();
        return view('backend.tampil_kelestarian_lingkungan_hidup', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = KelestarianLingkunganHidup::where('id_pokja4_bidang2', $id)->firstOrFail();
        $status = $request->status;

        if (in_array(strtolower($status), ['disetujui', 'disetujui1', 'disetujui2'])) {
            $status = Auth::guard('web')->check() ? 'Disetujui2' : 'Disetujui1';
        }

        $data->update([
            'jamban' => $request->jamban ?? $data->jamban,
            'spal'   => $request->spal ?? $data->spal,
            'tps'    => $request->tps ?? $data->tps,
            'mck'    => $request->mck ?? $data->mck,
            'pdam'   => $request->pdam ?? $data->pdam,
            'sumur'  => $request->sumur ?? $data->sumur,
            'dll'    => $request->dll ?? $data->dll,
            'status' => $status,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('kelestarian_lingkungan_hidup.index')->with(['success' => 'Berhasil Mengubah Status']);
    }

    public function destroy($id)
    {
        KelestarianLingkunganHidup::where('id_pokja4_bidang2', $id)->delete();
        return redirect()->route('kelestarian_lingkungan_hidup.index')->with(['success' => 'Laporan Berhasil Dihapus']);
    }
}