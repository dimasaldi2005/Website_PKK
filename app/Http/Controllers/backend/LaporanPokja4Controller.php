<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\LaporanPokja4; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class LaporanPokja4Controller extends Controller
{
    public function index(Request $request)
    {
        $data = collect();

        if (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            $query = DB::table('laporan_kader_pokja4')
                ->leftJoin('users_mobile', 'laporan_kader_pokja4.id_user', '=', 'users_mobile.id')
                ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                ->select(
                    'laporan_kader_pokja4.*',
                    'subdistrict.name as nama_kec',
                    'village.name as nama_desa'
                )
                ->whereIn('laporan_kader_pokja4.status', ['Proses', 'proses'])
                ->orderBy('laporan_kader_pokja4.id_kader_pokja4', 'desc');

            if ($user->id_role == 2) {
                // Kecamatan
                $query->where('users_mobile.id_subdistrict', $user->id_subdistrict);
            } else {
                // Desa
                $query->where('laporan_kader_pokja4.id_user', $user->id);
            }

            $data = $query->get();

        } else {
            // Admin web
            $data = DB::table('laporan_kader_pokja4')
                ->leftJoin('users_mobile', 'laporan_kader_pokja4.id_user', '=', 'users_mobile.id')
                ->leftJoin('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->leftJoin('village', 'users_mobile.id_village', '=', 'village.id')
                ->select(
                    'laporan_kader_pokja4.*',
                    'subdistrict.name as nama_kec',
                    'village.name as nama_desa'
                )
                ->whereIn('laporan_kader_pokja4.status', ['Proses', 'proses', 'Disetujui1'])
                ->orderBy('laporan_kader_pokja4.id_kader_pokja4', 'desc')
                ->get();
        }
        
        return view('backend.laporanpokja4', compact('data'));
    }

    public function create()
    {
        return view('backend.laporanpokja4_create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kec' => 'required|string|max:255',
            'nama_desa' => 'required|string|max:255',
            'dusun_lingkungan' => 'nullable|string|max:255',
            'PKK_RW' => 'nullable|integer|min:0',
            'PKK_RT' => 'nullable|integer|min:0',
            'desa_wisma' => 'nullable|string|max:255',
            'KRT' => 'nullable|integer|min:0',
            'KK' => 'nullable|integer|min:0',
            'jiwa_laki' => 'nullable|integer|min:0',
            'jiwa_perempuan' => 'nullable|integer|min:0',
            'anggota_laki' => 'nullable|integer|min:0',
            'anggota_perempuan' => 'nullable|integer|min:0',
            'umum_laki' => 'nullable|integer|min:0',
            'umum_perempuan' => 'nullable|integer|min:0',
            'khusus_laki' => 'nullable|integer|min:0',
            'khusus_perempuan' => 'nullable|integer|min:0',
            'honorer_laki' => 'nullable|integer|min:0',
            'honorer_perempuan' => 'nullable|integer|min:0',
            'bantuan_laki' => 'nullable|integer|min:0',
            'bantuan_perempuan' => 'nullable|integer|min:0',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);
        
        try {
            if (Auth::guard('pengguna')->check()) {
                $validated['id_pengguna'] = Auth::guard('pengguna')->id();
            }
            LaporanPokja4::create($validated);
            return redirect()->route('laporanpokja4.index')->with('success', 'Data laporan berhasil ditambahkan!');
        } catch (\Exception $e) {
            Log::error('Error store laporan pokja4: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function show(string $id)
    {
        $data = LaporanPokja4::where('id_kader_pokja4', $id)->first();
        return view('backend.tampil_laporanpokja4', compact('data'));
    }

    public function edit(string $id)
    {
        $data = LaporanPokja4::where('id_kader_pokja4', $id)->first();
        return view('backend.tampil_laporanpokja4', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $data = LaporanPokja4::where('id_kader_pokja4', $id)->first();
        if(!$data) return redirect()->back()->with('error', 'Data tidak ditemukan');
        
        $status = $request->status;
        if ($status == 'Disetujui' || $status == 'disetujui') {
            $status = Auth::guard('web')->check() ? 'Disetujui2' : 'Disetujui1';
        }
        
        try {
            $data->update(['status' => $status]);
            return redirect()->route('laporanpokja4.index')->with('success', 'Data laporan berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        $data = LaporanPokja4::where('id_kader_pokja4', $id)->first();
        if($data) {
            $data->delete();
            return redirect()->route('laporanpokja4.index')->with('success', 'Data berhasil dihapus');
        }
        return redirect()->back()->with('error', 'Data gagal dihapus');
    }

    // FUNGSI INI YANG DIPAKAI UNTUK MENGIRIM JSON KE GOOGLE SHEETS
    public function getExportData(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $bidang = $request->bidang;

        $data = [];

        // ARRAY SEMUA STATUS AGAR UJICOBA EXPORT BISA JALAN WALAUPUN STATUS MASIH "PROSES"
        $semuaStatus = ['Proses', 'proses', 'Disetujui1', 'Disetujui2'];

        try {
            if ($bidang == 'kesehatan') {
                $data = DB::table('laporan_bidang_kesehatan')
                    ->join('users_mobile', 'laporan_bidang_kesehatan.id_user', '=', 'users_mobile.id')
                    ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->join('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('subdistrict.name as nama_kecamatan', 'village.name as nama_desa', 'laporan_bidang_kesehatan.*')
                    ->when($bulan, fn($q) => $q->whereMonth('laporan_bidang_kesehatan.created_at', $bulan))
                    ->when($tahun, fn($q) => $q->whereYear('laporan_bidang_kesehatan.created_at', $tahun))
                    ->whereIn('laporan_bidang_kesehatan.status', $semuaStatus) 
                    ->get();

            } elseif ($bidang == 'kelestarian') {
                $data = DB::table('laporan_kelestarian_lingkungan_hidup')
                    ->join('users_mobile', 'laporan_kelestarian_lingkungan_hidup.id_user', '=', 'users_mobile.id')
                    ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->join('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('subdistrict.name as nama_kecamatan', 'village.name as nama_desa', 'laporan_kelestarian_lingkungan_hidup.*')
                    ->when($bulan, fn($q) => $q->whereMonth('laporan_kelestarian_lingkungan_hidup.created_at', $bulan))
                    ->when($tahun, fn($q) => $q->whereYear('laporan_kelestarian_lingkungan_hidup.created_at', $tahun))
                    ->whereIn('laporan_kelestarian_lingkungan_hidup.status', $semuaStatus) 
                    ->get();

            } elseif ($bidang == 'perencanaan') {
                $data = DB::table('laporan_perencanaan_sehat')
                    ->join('users_mobile', 'laporan_perencanaan_sehat.id_user', '=', 'users_mobile.id')
                    ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->join('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('subdistrict.name as nama_kecamatan', 'village.name as nama_desa', 'laporan_perencanaan_sehat.*')
                    ->when($bulan, fn($q) => $q->whereMonth('laporan_perencanaan_sehat.created_at', $bulan))
                    ->when($tahun, fn($q) => $q->whereYear('laporan_perencanaan_sehat.created_at', $tahun))
                    ->whereIn('laporan_perencanaan_sehat.status', $semuaStatus) 
                    ->get();

            } elseif ($bidang == 'kader') {
                $data = DB::table('laporan_kader_pokja4')
                    ->join('users_mobile', 'laporan_kader_pokja4.id_user', '=', 'users_mobile.id')
                    ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                    ->join('village', 'users_mobile.id_village', '=', 'village.id')
                    ->select('subdistrict.name as nama_kecamatan', 'village.name as nama_desa', 'laporan_kader_pokja4.*')
                    ->when($bulan, fn($q) => $q->whereMonth('laporan_kader_pokja4.created_at', $bulan))
                    ->when($tahun, fn($q) => $q->whereYear('laporan_kader_pokja4.created_at', $tahun))
                    ->whereIn('laporan_kader_pokja4.status', $semuaStatus) 
                    ->get();
            }

            return response()->json([
                'status' => 'success',
                'bidang' => $bidang,
                'data' => $data
            ]);

        } catch (\Exception $e) {
            Log::error('Error getExport Pokja 4: ' . $e->getMessage()); 
            return response()->json([
                'status' => 'error',
                'message' => 'Error Laravel: ' . $e->getMessage()
            ], 500);
        }
    }
}