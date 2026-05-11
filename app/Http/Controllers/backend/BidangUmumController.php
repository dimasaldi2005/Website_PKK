<?php

namespace App\Http\Controllers\backend;

use Carbon\Carbon;
use App\Models\Ttd;
use App\Models\Ttds;
use App\Models\BidangUmum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BidangUmumController extends Controller
{
    public function index()
    {
        $data = collect();

        // 1. JIKA YANG LOGIN ADMIN WEB
        if (Auth::guard('web')->check()) {
            $data = DB::table('laporan_umum')
                ->leftJoin('users_mobile', 'laporan_umum.id_user', '=', 'users_mobile.id')
                ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('laporan_umum.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                // Tampilkan Disetujui1 dan Proses agar Admin bisa memantau
                ->whereIn('laporan_umum.status', ['Disetujui1', 'disetujui1', 'DISETUJUI1', 'proses', 'Proses', 'PROSES'])
                ->orderBy('id_laporan_umum', 'desc')
                ->get();
        } 
        // 2. JIKA YANG LOGIN PENGGUNA MOBILE
        else if (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) { // Kecamatan (role 2)
                $data = DB::table('laporan_umum')
                    ->leftJoin('users_mobile', 'laporan_umum.id_user', '=', 'users_mobile.id')
                    ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('laporan_umum.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1) // Hanya desa
                    ->whereIn('laporan_umum.status', ['proses', 'Proses', 'PROSES'])
                    ->orderBy('id_laporan_umum', 'desc')
                    ->get();
            }
        }

        return view('backend.bidangumum', compact('data'));
    }

    public function edit(string $id_laporan_umum)
    {
        $data = BidangUmum::find($id_laporan_umum);
        return view('backend.tampil_bidangumum', compact('data'));
    }

    public function update(Request $request, string $id_laporan_umum)
    {
        $data = BidangUmum::find($id_laporan_umum);
        $status = $request->status;

        // Penyesuaian otomatis status menjadi Disetujui1/Disetujui2
        if (strtolower($status) == 'disetujui') {
            $status = Auth::guard('pengguna')->check() ? 'Disetujui1' : 'Disetujui2';
        }

        // Kita gunakan (??) agar jika data dari form kosong, dia akan tetap memakai data lama dari database
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
            'id_user'           => $request->id_user ?? $data->id_user,
            
            // Status dan Catatan tetap di-update
            'status'            => $status,
            'catatan'           => $request->catatan,
            
            // BARIS 'created_at' DIHAPUS KARENA MEMBUAT ERROR 1048
        ]);

        return redirect()->route('bidangumum.index')->with(['success' => 'Berhasil Mengubah Status']);
    }

    public function filter(Request $request)
    {
        // Tentukan array status berdasarkan guard yang aktif
        $statusArray = Auth::guard('web')->check() ? ['Disetujui2', 'disetujui2', 'DISETUJUI2'] : ['Disetujui1', 'disetujui1', 'DISETUJUI1'];

        $baseQuery = DB::table('laporan_umum')
            ->leftJoin('users_mobile', 'laporan_umum.id_user', '=', 'users_mobile.id')
            ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
            ->select('laporan_umum.*', 'subdistrict.name as nama_kec')
            ->whereIn('laporan_umum.status', $statusArray);

        // Jika guard pengguna (mobile) - tambahkan filter berdasarkan role
        if (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();
            if ($user->id_role == 2) { // Kecamatan
                $baseQuery->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1); // Hanya desa
            }
        }

        if ($request->has('search')) {
            $bidangumum = $baseQuery->where('laporan_umum.created_at', 'LIKE', '%' . $request->search . '%')->get();

            // Cek data kosong
            if ($bidangumum->isEmpty()) {
                return back()->with('error', 'Tidak ada data laporan untuk periode tersebut');
            }

            $total1 = $bidangumum->sum('dusun_lingkungan');
            $total2 = $bidangumum->sum('PKK_RW');
            $total3 = $bidangumum->sum('desa_wisma');
            $total4 = $bidangumum->sum('KRT');
            $total5 = $bidangumum->sum('KK');
            $total6 = $bidangumum->sum('jiwa_laki');
            $total7 = $bidangumum->sum('jiwa_perempuan');
            $total8 = $bidangumum->sum('anggota_laki');
            $total9 = $bidangumum->sum('anggota_perempuan');
            $total10 = $bidangumum->sum('umum_laki');
            $total11 = $bidangumum->sum('umum_perempuan');
            $total12 = $bidangumum->sum('khusus_laki');
            $total13 = $bidangumum->sum('khusus_perempuan');
            $total14 = $bidangumum->sum('honorer_laki');
            $total15 = $bidangumum->sum('honorer_perempuan');
            $total16 = $bidangumum->sum('bantuan_laki');
            $total17 = $bidangumum->sum('bantuan_perempuan');

            $currentDate = Carbon::now();
            $formattedDate = $currentDate->isoFormat('dddd, D MMMM YYYY');
            
            $tanggal = $request->input('search');
            try {
                $carbonDate = Carbon::parse($tanggal);
                $tanggal = $carbonDate->isoFormat('MMMM YYYY');
            } catch (\Exception $e) {}

            $ketua = Ttd::where('jabatan', 'Sekretaris')->where('pokja', 'Bidang Umum')->get();
            $wakil = Ttd::where('jabatan', 'Ketua')->where('id_ttds', '12')->get();

            return view('backend.cetak_bulan_bidangumum', compact(
                'bidangumum', 'total1', 'total2', 'total3', 'total4', 'tanggal', 'total5', 'total6', 'total7', 'total8', 
                'total9', 'total10', 'total11', 'total12', 'total13', 'total14', 'total15', 'total16', 'total17', 
                'formattedDate', 'ketua', 'wakil'
            ));

        } elseif ($request->has('search2')) {
            $bidangumum = $baseQuery->where('laporan_umum.created_at', 'LIKE', '%' . $request->search2 . '%')->get();

            // Cek data kosong
            if ($bidangumum->isEmpty()) {
                return back()->with('error', 'Tidak ada data laporan untuk periode tersebut');
            }

            $total1 = $bidangumum->sum('dusun_lingkungan');
            $total2 = $bidangumum->sum('PKK_RW');
            $total3 = $bidangumum->sum('desa_wisma');
            $total4 = $bidangumum->sum('KRT');
            $total5 = $bidangumum->sum('KK');
            $total6 = $bidangumum->sum('jiwa_laki');
            $total7 = $bidangumum->sum('jiwa_perempuan');
            $total8 = $bidangumum->sum('anggota_laki');
            $total9 = $bidangumum->sum('anggota_perempuan');
            $total10 = $bidangumum->sum('umum_laki');
            $total11 = $bidangumum->sum('umum_perempuan');
            $total12 = $bidangumum->sum('khusus_laki');
            $total13 = $bidangumum->sum('khusus_perempuan');
            $total14 = $bidangumum->sum('honorer_laki');
            $total15 = $bidangumum->sum('honorer_perempuan');
            $total16 = $bidangumum->sum('bantuan_laki');
            $total17 = $bidangumum->sum('bantuan_perempuan');

            $currentDate = Carbon::now();
            $formattedDate = $currentDate->isoFormat('dddd, D MMMM YYYY');
            $tanggal = $request->input('search2');
            
            $ketua = Ttd::where('jabatan', 'Sekretaris')->where('pokja', 'Bidang Umum')->get();
            $wakil = Ttd::where('jabatan', 'Ketua')->where('id_ttds', '12')->get();

            return view('backend.cetak_tahun_bidangumum', compact(
                'bidangumum', 'total1', 'total2', 'total3', 'total4', 'tanggal', 'total5', 'total6', 'total7', 'total8', 
                'total9', 'total10', 'total11', 'total12', 'total13', 'total14', 'total15', 'total16', 'total17', 
                'formattedDate', 'ketua', 'wakil'
            ));
        }

        return redirect()->back();
    }

    public function destroy(string $id_laporan_umum)
    {
        $data = BidangUmum::find($id_laporan_umum);
        if ($data) {
            $data->delete();
            return redirect()->route('bidangumum.index')->with(['success' => 'Berhasil Menghapus Laporan']);
        }
        return redirect()->route('bidangumum.index')->with(['error' => 'Data tidak ditemukan']);
    }
}