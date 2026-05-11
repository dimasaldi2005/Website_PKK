<?php

namespace App\Http\Controllers\backend;

use Carbon\Carbon;
use App\Models\Ttd;
use App\Models\Ttds;
use App\Models\Pangan;
use App\Models\Sandang;
use App\Models\Perumahan;
use Illuminate\Http\Request;
use App\Models\LaporanPokja3;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Pengguna;

class PanganController extends Controller
{
    public function index()
    {
        $data = collect();

        // 1. JIKA YANG LOGIN ADMIN WEB
        if (Auth::guard('web')->check()) {
            $data = DB::table('laporan_pangan')
                ->leftJoin('users_mobile', 'laporan_pangan.id_user', '=', 'users_mobile.id')
                ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('laporan_pangan.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                // Tampilkan Disetujui1 dan Proses agar Admin bisa memantau
                ->whereIn('laporan_pangan.status', ['Disetujui1', 'disetujui1', 'DISETUJUI1', 'proses', 'Proses', 'PROSES'])
                ->orderBy('id_pokja3_bidang1', 'desc')
                ->get();
        } 
        // 2. JIKA YANG LOGIN PENGGUNA MOBILE (KECAMATAN)
        elseif (Auth::guard('pengguna')->check()) { // <-- Tadi salah tulis jadi users_mobile
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) { // Kecamatan
                $data = DB::table('laporan_pangan')
                    ->leftJoin('users_mobile', 'laporan_pangan.id_user', '=', 'users_mobile.id')
                    ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('laporan_pangan.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1) // Hanya desa
                    ->whereIn('laporan_pangan.status', ['proses', 'Proses', 'PROSES'])
                    ->orderBy('id_pokja3_bidang1', 'desc')
                    ->get();
            }
        }

        return view('backend.pangan', compact('data'));
    }

    public function edit(string $id_pokja3_bidang1)
    {
        $data = Pangan::find($id_pokja3_bidang1);

        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }

        $user = Pengguna::find($data->id_user);
        $kecamatan = $user ? DB::table('subdistrict')->where('id', $user->id_subdistrict)->first() : null;
        $desa = $user ? DB::table('village')->where('id', $user->id_village)->first() : null;

        return view('backend.tampil_pangan', compact('data', 'kecamatan', 'desa'));
    }

    public function update(Request $request, string $id_pokja3_bidang1)
    {
        $data = Pangan::find($id_pokja3_bidang1);

        $status = $request->status;
        if (strtolower($status) == 'disetujui') {
            $status = Auth::guard('pengguna')->check() ? 'Disetujui1' : 'Disetujui2';
        }

        // Pakai ?? agar saat tombol disetujui ditekan, data angkanya tidak terhapus (hilang)
        $data->update([
            'beras'         => $request->beras ?? $data->beras,
            'non_beras'     => $request->non_beras ?? $data->non_beras,
            'peternakan'    => $request->peternakan ?? $data->peternakan,
            'perikanan'     => $request->perikanan ?? $data->perikanan,
            'warung_hidup'  => $request->warung_hidup ?? $data->warung_hidup,
            'lumbung_hidup' => $request->lumbung_hidup ?? $data->lumbung_hidup,
            'toga'          => $request->toga ?? $data->toga,
            'tanaman_keras' => $request->tanaman_keras ?? $data->tanaman_keras,
            'status'        => $status,
            'catatan'       => $request->catatan,
        ]);

        return redirect()->route('pangan.index')->with(['success' => 'Berhasil Mengubah Status']);
    }

    public function filter(Request $request)
    {
        $statusArray = Auth::guard('web')->check() ? ['Disetujui2', 'disetujui2', 'DISETUJUI2'] : ['Disetujui1', 'disetujui1', 'DISETUJUI1'];

        if ($request->has('search') || $request->has('search2')) {
            
            $searchTerm = $request->has('search') ? $request->search : $request->search2;
            $isYearly = $request->has('search2');

            // --- QUERY PANGAN ---
            $pangan = DB::table('laporan_pangan')
                ->leftJoin('users_mobile', 'laporan_pangan.id_user', '=', 'users_mobile.id')
                ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->select('laporan_pangan.*', 'subdistrict.name as nama_kec')
                ->when($isYearly, function($q) use ($searchTerm){
                    return $q->whereYear('laporan_pangan.created_at', $searchTerm);
                }, function($q) use ($searchTerm){
                    return $q->where('laporan_pangan.created_at', 'LIKE', '%' . $searchTerm . '%');
                })
                ->whereIn('laporan_pangan.status', $statusArray)
                ->get();

            $total1 = $pangan->sum('beras');
            $total2 = $pangan->sum('non_beras');
            $total3 = $pangan->sum('peternakan');
            $total31 = $pangan->sum('perikanan');
            $total4 = $pangan->sum('warung_hidup');
            $total5 = $pangan->sum('lumbung_hidup');
            $total6 = $pangan->sum('toga');
            $total7 = $pangan->sum('tanaman_keras');

            // --- QUERY SANDANG ---
            $sandang = DB::table('laporan_sandang')
                ->leftJoin('users_mobile', 'laporan_sandang.id_user', '=', 'users_mobile.id')
                ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->select('laporan_sandang.*', 'subdistrict.name as nama_kec')
                ->when($isYearly, function($q) use ($searchTerm){
                    return $q->whereYear('laporan_sandang.created_at', $searchTerm);
                }, function($q) use ($searchTerm){
                    return $q->where('laporan_sandang.created_at', 'LIKE', '%' . $searchTerm . '%');
                })
                ->whereIn('laporan_sandang.status', $statusArray)
                ->get();

            $total24 = $sandang->sum('pangan');
            $total25 = $sandang->sum('sandang');
            $total26 = $sandang->sum('jasa');

            // --- QUERY PERUMAHAN ---
            $perumahan = DB::table('laporan_perumahan')
                ->leftJoin('users_mobile', 'laporan_perumahan.id_user', '=', 'users_mobile.id')
                ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->select('laporan_perumahan.*', 'subdistrict.name as nama_kec')
                ->when($isYearly, function($q) use ($searchTerm){
                    return $q->whereYear('laporan_perumahan.created_at', $searchTerm);
                }, function($q) use ($searchTerm){
                    return $q->where('laporan_perumahan.created_at', 'LIKE', '%' . $searchTerm . '%');
                })
                ->whereIn('laporan_perumahan.status', $statusArray)
                ->get();

            $total8 = $perumahan->sum('layak_huni');
            $total9 = $perumahan->sum('tidak_layak');

            // --- QUERY POKJA 3 ---
            $laporanpokja3 = DB::table('laporan_kader_pokja3')
                ->leftJoin('users_mobile', 'laporan_kader_pokja3.id_user', '=', 'users_mobile.id')
                ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->select('laporan_kader_pokja3.*', 'subdistrict.name as nama_kec')
                ->when($isYearly, function($q) use ($searchTerm){
                    return $q->whereYear('laporan_kader_pokja3.created_at', $searchTerm);
                }, function($q) use ($searchTerm){
                    return $q->where('laporan_kader_pokja3.created_at', 'LIKE', '%' . $searchTerm . '%');
                })
                ->whereIn('laporan_kader_pokja3.status', $statusArray)
                ->get();

            $total10 = $laporanpokja3->sum('pangan');
            $total11 = $laporanpokja3->sum('sandang');
            $total12 = $laporanpokja3->sum('tata_laksana_rumah');

            // Cek data kosong
            if ($pangan->isEmpty() && $sandang->isEmpty() && $perumahan->isEmpty() && $laporanpokja3->isEmpty()) {
                return back()->with('error', 'Tidak ada data laporan untuk periode tersebut');
            }

            $currentDate = Carbon::now();
            $formattedDate = $currentDate->isoFormat('dddd, D MMMM YYYY');
            
            $created_at = $searchTerm;
            if (!$isYearly) {
                try {
                    $carbonDate = Carbon::parse($searchTerm);
                    $created_at = $carbonDate->isoFormat('MMMM YYYY');
                } catch (\Exception $e) {}
            }

            $ketua = Ttd::where('jabatan', 'Ketua')->where('pokja', 'Kelompok Kerja III')->get();
            $wakil = Ttd::where('jabatan', 'Ketua')->where('id_ttds', '12')->get();

            $viewName = $isYearly ? 'backend.cetak_tahun_pokja3' : 'backend.cetak_bulan_pokja3';

            return view($viewName, compact(
                'pangan', 'sandang', 'perumahan', 'laporanpokja3',
                'total1', 'total2', 'total3', 'total4', 'total5', 'total6', 'total7', 'total8', 'total9', 'total10',
                'total11', 'total12', 'total24', 'total25', 'total26', 'total31',
                'formattedDate', 'ketua', 'wakil', 'created_at'
            ));
        }

        return redirect()->back();
    }

    public function destroy(string $id_pokja3_bidang1)
    {
        $data = Pangan::find($id_pokja3_bidang1);
        if ($data) {
            $data->delete();
            return redirect()->route('pangan.index')->with(['success' => 'Berhasil Menghapus Laporan']);
        }
        return redirect()->route('pangan.index')->with(['error' => 'Data tidak ditemukan']);
    }
}