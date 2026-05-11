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

        if (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            $query = DB::table('laporan_bidang_kesehatan')
                ->leftJoin('users_mobile', 'laporan_bidang_kesehatan.id_user', '=', 'users_mobile.id')
                ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                ->select(
                    'laporan_bidang_kesehatan.*',
                    'subdistrict.name as nama_kec',
                    'village.name as nama_desa'
                )
                ->whereIn('laporan_bidang_kesehatan.status', ['Proses', 'proses']) 
                ->orderBy('laporan_bidang_kesehatan.id_pokja4_bidang1', 'desc');

            if ($user->id_role == 2) {
                // Kecamatan melihat data "Proses" di desanya
                $query->where('users_mobile.id_subdistrict', $user->id_subdistrict);
            } else {
                // Desa melihat datanya sendiri
                $query->where('laporan_bidang_kesehatan.id_user', $user->id);
            }

            $data = $query->get();

        } else {
            // PERBAIKAN: Admin web sekarang diizinkan melihat data 'Proses' dan 'Disetujui1' di dalam tabel
            $data = DB::table('laporan_bidang_kesehatan')
                ->leftJoin('users_mobile', 'laporan_bidang_kesehatan.id_user', '=', 'users_mobile.id')
                ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                ->select(
                    'laporan_bidang_kesehatan.*',
                    'subdistrict.name as nama_kec',
                    'village.name as nama_desa'
                )
                ->whereIn('laporan_bidang_kesehatan.status', ['Proses', 'proses', 'Disetujui1']) // <-- Di sini kuncinya
                ->orderBy('laporan_bidang_kesehatan.id_pokja4_bidang1', 'desc')
                ->get();
        }

        // Variabel untuk dashboard jika masih digunakan di view
        $semuaStatus = ['Proses', 'proses', 'Disetujui1', 'Disetujui2'];
        $modelPertama = DB::table('laporan_bidang_kesehatan')->whereIn('status', $semuaStatus)->count();
        $modelKedua   = DB::table('laporan_kelestarian_lingkungan_hidup')->whereIn('status', $semuaStatus)->count();
        $modelKetiga  = DB::table('laporan_perencanaan_sehat')->whereIn('status', $semuaStatus)->count();
        $modelKeempat = DB::table('laporan_kader_pokja4')->whereIn('status', $semuaStatus)->count();
        $modelKelima  = DB::table('inovasi')->whereIn('status', $semuaStatus)->count();

        return view('backend.kesehatan', compact(
            'data', 'modelPertama', 'modelKedua', 'modelKetiga', 'modelKeempat', 'modelKelima'
        ));
    }

    public function edit($id)
    {
        $data = Kesehatan::where('id_pokja4_bidang1', $id)->first();
        return view('backend.tampil_kesehatan', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Kesehatan::where('id_pokja4_bidang1', $id)->first();

        $status = $request->status;

        if ($status == 'Disetujui' || $status == 'disetujui') {
            $status = Auth::guard('web')->check() ? 'Disetujui2' : 'Disetujui1';
        }

        $data->update([
            'jumlah_posyandu' => $request->jumlah_posyandu,
            'jumlah_posyandu_iterasi' => $request->jumlah_posyandu_iterasi,
            'jumlah_klp' => $request->jumlah_klp,
            'jumlah_anggota' => $request->jumlah_anggota,
            'jumlah_kartu_gratis' => $request->jumlah_kartu_gratis,
            'status' => $status,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('kesehatan.index')
            ->with('success', 'Berhasil Mengubah Status');
    }

    public function show(Request $request)
    {
        $jenis  = $request->jenis;
        $bulan  = $request->bulan;
        $tahun  = $request->tahun;
        $bidang = $request->bidang ?? 'semua';

        $query = DB::table('laporan_bidang_kesehatan')
            ->leftJoin('users_mobile', 'laporan_bidang_kesehatan.id_user', '=', 'users_mobile.id')
            ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
            ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
            ->select(
                'laporan_bidang_kesehatan.*',
                'subdistrict.name as nama_kec',
                'village.name as nama_desa'
            )
            ->where('laporan_bidang_kesehatan.status', 'Disetujui2');

        if ($jenis == 'bulan') {
            $query->whereMonth('laporan_bidang_kesehatan.created_at', $bulan)
                  ->whereYear('laporan_bidang_kesehatan.created_at', $tahun);
        }

        if ($jenis == 'tahun') {
            $query->whereYear('laporan_bidang_kesehatan.created_at', $tahun);
        }

        if ($jenis == 'bidang') {
            $query->whereMonth('laporan_bidang_kesehatan.created_at', $bulan)
                  ->whereYear('laporan_bidang_kesehatan.created_at', $tahun);
        }

        $data = $query->get();

        $namaBulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        $bulan_nama = $namaBulan[(int)$bulan] ?? '';

        return view('backend.cetak_tahun_pokja4', compact(
            'data', 'jenis', 'bulan', 'tahun', 'bidang', 'bulan_nama'
        ));
    }

    public function destroy($id)
    {
        $data = Kesehatan::where('id_pokja4_bidang1', $id)->first();
        if($data){
            $data->delete();
        }
        return redirect()->route('kesehatan.index')
            ->with('success', 'Berhasil Menghapus Laporan');
    }
}