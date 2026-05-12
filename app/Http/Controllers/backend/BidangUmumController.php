<?php

namespace App\Http\Controllers\backend;

use Carbon\Carbon;
use App\Models\Ttd;
use App\Models\BidangUmum;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BidangUmumController extends Controller
{
    public function index()
    {
        $data = collect();

        // 1. ADMIN WEB: Hanya lihat yang sudah di-ACC Kecamatan (Disetujui1)
        if (Auth::guard('web')->check()) {
            $data = DB::table('laporan_umum')
                ->join('users_mobile', 'laporan_umum.id_user', '=', 'users_mobile.id')
                ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->join('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('laporan_umum.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                ->where('laporan_umum.status', 'Disetujui1')
                ->orderBy('id_laporan_umum', 'desc')->get();
        } 
        // 2. PENGGUNA MOBILE
        else if (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();
            if ($user->id_role == 2) { // KECAMATAN: Hanya lihat Proses
                $data = DB::table('laporan_umum')
                    ->join('users_mobile', 'laporan_umum.id_user', '=', 'users_mobile.id')
                    ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->join('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('laporan_umum.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('laporan_umum.status', 'Proses')
                    ->orderBy('id_laporan_umum', 'desc')->get();
            } else { // DESA: Lihat milik sendiri
                $data = DB::table('laporan_umum')
                    ->join('users_mobile', 'laporan_umum.id_user', '=', 'users_mobile.id')
                    ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->join('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('laporan_umum.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->where('laporan_umum.id_user', $user->id)
                    ->orderBy('id_laporan_umum', 'desc')->get();
            }
        }

        return view('backend.bidangumum', compact('data'));
    }

    public function edit(string $id_laporan_umum)
    {
        $data = BidangUmum::where('id_laporan_umum', $id_laporan_umum)->firstOrFail();
        return view('backend.tampil_bidangumum', compact('data'));
    }

    public function update(Request $request, string $id_laporan_umum)
    {
        $data = BidangUmum::where('id_laporan_umum', $id_laporan_umum)->firstOrFail();
        $status = $request->status;

        if (in_array(strtolower($status), ['disetujui', 'disetujui1', 'disetujui2'])) {
            $status = Auth::guard('web')->check() ? 'Disetujui2' : 'Disetujui1';
        }

        $data->update([
            'dusun_lingkungan'  => $request->dusun_lingkungan ?? $data->dusun_lingkungan,
            'PKK_RW'            => $request->PKK_RW ?? $data->PKK_RW,
            'desa_wisma'        => $request->desa_wisma ?? $data->desa_wisma,
            'KRT'               => $request->KRT ?? $data->KRT,
            'KK'                => $request->KK ?? $data->KK,
            'jiwa_laki'         => $request->jiwa_laki ?? $data->jiwa_laki,
            'jiwa_perempuan'    => $request->jiwa_perempuan ?? $data->jiwa_perempuan,
            'anggota_laki'      => $request->anggota_laki ?? $data->anggota_laki,
            'anggota_perempuan' => $request->anggota_perempuan ?? $data->anggota_perempuan,
            'umum_laki'         => $request->umum_laki ?? $data->umum_laki,
            'umum_perempuan'    => $request->umum_perempuan ?? $data->umum_perempuan,
            'khusus_laki'       => $request->khusus_laki ?? $data->khusus_laki,
            'khusus_perempuan'  => $request->khusus_perempuan ?? $data->khusus_perempuan,
            'honorer_laki'      => $request->honorer_laki ?? $data->honorer_laki,
            'honorer_perempuan' => $request->honorer_perempuan ?? $data->honorer_perempuan,
            'bantuan_laki'      => $request->bantuan_laki ?? $data->bantuan_laki,
            'bantuan_perempuan' => $request->bantuan_perempuan ?? $data->bantuan_perempuan,
            'status'            => $status,
            'catatan'           => $request->catatan,
            'updated_at'        => now()
        ]);

        return redirect()->route('bidangumum.index')->with('success', 'Berhasil Mengubah Status');
    }

    public function filter(Request $request)
    {
        $statusTarget = Auth::guard('web')->check() ? 'Disetujui2' : 'Disetujui1';

        $query = DB::table('laporan_umum')
            ->join('users_mobile', 'laporan_umum.id_user', '=', 'users_mobile.id')
            ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
            ->select('laporan_umum.*', 'subdistrict.name as nama_kec')
            ->where('laporan_umum.status', $statusTarget);

        if (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();
            if ($user->id_role == 2) $query->where('users_mobile.id_subdistrict', $user->id_subdistrict);
        }

        $searchTerm = $request->search ?? $request->search2;
        $bidangumum = $query->where('laporan_umum.created_at', 'LIKE', '%' . $searchTerm . '%')->get();

        if ($bidangumum->isEmpty()) return back()->with('error', 'Tidak ada data laporan untuk periode tersebut');

        $totals = [];
        for($i=1; $i<=17; $i++) { /* logic sum total di sini jika diperlukan di view */ }

        $formattedDate = Carbon::now()->isoFormat('dddd, D MMMM YYYY');
        $ketua = Ttd::where('jabatan', 'Sekretaris')->where('pokja', 'Bidang Umum')->get();
        $viewName = $request->has('search2') ? 'backend.cetak_tahun_bidangumum' : 'backend.cetak_bulan_bidangumum';

        return view($viewName, compact('bidangumum', 'formattedDate', 'ketua'));
    }

    public function destroy($id)
    {
        BidangUmum::where('id_laporan_umum', $id)->delete();
        return redirect()->route('bidangumum.index')->with('success', 'Berhasil Menghapus Laporan');
    }
}