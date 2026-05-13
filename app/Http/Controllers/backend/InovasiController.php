<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class InovasiController extends Controller
{
    public function index()
    {
        $prioritas = DB::table('rekap_desa_bulanan')->where('kategori', 'prioritas')->count();
        $unggulan = DB::table('rekap_desa_bulanan')->where('kategori', 'Unggulan')->count();
        return view('backend.inovasi', compact('prioritas', 'unggulan'));
    }

    public function prioritas()
    {
        $bulanan = DB::table('rekap_desa_bulanan')->where('kategori', 'prioritas')->count();
        $tahunan = 0; $posyandu = 0; $kegiatan = 0;
        return view('backend.prioritas', compact('bulanan', 'tahunan', 'posyandu', 'kegiatan'));
    }

    public function unggulan()
    {
        $bulanan = DB::table('rekap_desa_bulanan')->where('kategori', 'Unggulan')->count();
        $tahunan = 0; $posyandu = 0; $kegiatan = 0;
        return view('backend.unggulan', compact('bulanan', 'tahunan', 'posyandu', 'kegiatan'));
    }

    /*
    |--------------------------------------------------------------------------
    | REKAP BULANAN UNGGULAN (BUG FIX: DATA AWAL TERFILTER)
    |--------------------------------------------------------------------------
    */
    public function unggulanBulanan(Request $request)
    {
        $data = collect();
        $statusFilter = $request->status;

        // =====================================
        // ADMIN WEB KABUPATEN
        // =====================================
        if (Auth::guard('web')->check()) {
            
            // JIKA BARU DIBUKA (KOSONG), DEFAULT KE DISETUJUI 1
            if (empty($statusFilter)) {
                $statusFilter = 'Disetujui1';
            }

            $data = DB::table('rekap_desa_bulanan')
                ->join('users_mobile', 'rekap_desa_bulanan.id_user', '=', 'users_mobile.id')
                ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->join('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('rekap_desa_bulanan.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                ->where('rekap_desa_bulanan.kategori', 'Unggulan')
                ->where('rekap_desa_bulanan.status', $statusFilter)
                ->latest('id_rekap_desa_bulanan')
                ->get();
        }

        // =====================================
        // USER KECAMATAN
        // =====================================
        elseif (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) {
                
                // JIKA BARU DIBUKA (KOSONG), DEFAULT KE PROSES
                if (empty($statusFilter)) {
                    $statusFilter = 'Proses';
                }

                $data = DB::table('rekap_desa_bulanan')
                    ->join('users_mobile as desa', 'rekap_desa_bulanan.id_user', '=', 'desa.id')
                    ->join('subdistrict', 'desa.id_subdistrict', '=', 'subdistrict.id')
                    ->join('village', 'desa.id_village', '=', 'village.id')
                    ->select('rekap_desa_bulanan.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->where('rekap_desa_bulanan.kategori', 'Unggulan')
                    ->where('desa.id_subdistrict', $user->id_subdistrict)
                    ->where('desa.id_role', 1)
                    ->where('rekap_desa_bulanan.status', $statusFilter)
                    ->latest('id_rekap_desa_bulanan')
                    ->get();
            }
        }

        // Kirim statusFilter ke view agar dropdown terpilih dengan benar
        $status = $statusFilter;
        return view('backend.unggulan_bulanan', compact('data', 'status'));
    }

    /*
    |--------------------------------------------------------------------------
    | FUNGSI EDIT, UPDATE, & HAPUS UNGGULAN
    |--------------------------------------------------------------------------
    */
    public function editUnggulan($id)
    {
        $data = DB::table('rekap_desa_bulanan')->where('id_rekap_desa_bulanan', $id)->first();
        if (!$data) return redirect()->route('unggulan.bulanan')->with(['error' => 'Data tidak ditemukan']);
        return view('backend.unggulan_bulanan_edit', compact('data'));
    }

    public function updateUnggulan(Request $request, $id)
    {
        try {
            DB::table('rekap_desa_bulanan')->where('id_rekap_desa_bulanan', $id)->update([
                'rw' => $request->rw ?? 0,
                'rt' => $request->rt ?? 0,
                'dasa_wisma' => $request->dasa_wisma ?? 0,
                'hamil' => $request->hamil ?? 0,
                'melahirkan' => $request->melahirkan ?? 0,
                'nifas' => $request->nifas ?? 0,
                'meninggal' => $request->meninggal ?? 0,
                'bayi_lahir_l' => $request->bayi_lahir_l ?? 0,
                'bayi_lahir_p' => $request->bayi_lahir_p ?? 0,
                'akte_kelahiran_ada' => $request->akte_kelahiran_ada ?? 0,
                'akte_kelahiran_tidak' => $request->akte_kelahiran_tidak ?? 0,
                'bayi_meninggal_l' => $request->bayi_meninggal_l ?? 0,
                'bayi_meninggal_p' => $request->bayi_meninggal_p ?? 0,
                'balita_meninggal_l' => $request->balita_meninggal_l ?? 0,
                'balita_meninggal_p' => $request->balita_meninggal_p ?? 0,
                'status' => $request->status,
                'catatan' => $request->catatan,
                'updated_at' => Carbon::now(),
            ]);
            return redirect()->route('unggulan.bulanan')->with(['success' => 'Berhasil Memperbarui Laporan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Gagal memperbarui data: ' . $e->getMessage()]);
        }
    }

    public function destroyUnggulan($id)
    {
        try {
            DB::table('rekap_desa_bulanan')->where('id_rekap_desa_bulanan', $id)->delete();
            return redirect()->route('unggulan.bulanan')->with(['success' => 'Berhasil Menghapus Laporan']);
        } catch (\Exception $e) {
            return redirect()->route('unggulan.bulanan')->with(['error' => 'Gagal menghapus data: ' . $e->getMessage()]);
        }
    }

    //--------------------------------------------------------------------------
    // HALAMAN PRIORITAS BULANAN 
    //--------------------------------------------------------------------------
    public function prioritasBulanan(Request $request)
    {
        $data = collect();
        $statusFilter = $request->status;

        if (Auth::guard('web')->check()) {
            if (empty($statusFilter)) $statusFilter = 'Disetujui1';

            $data = DB::table('rekap_desa_bulanan')
                ->join('users_mobile', 'rekap_desa_bulanan.id_user', '=', 'users_mobile.id')
                ->join('subdistrict', 'users_mobile.id_subdistrict', '=', 'subdistrict.id')
                ->join('village', 'users_mobile.id_village', '=', 'village.id')
                ->select('rekap_desa_bulanan.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                ->where('rekap_desa_bulanan.kategori', 'prioritas')
                ->where('rekap_desa_bulanan.status', $statusFilter)
                ->latest('id_rekap_desa_bulanan')
                ->get();

        } elseif (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();
            if ($user->id_role == 2) {
                if (empty($statusFilter)) $statusFilter = 'Proses';

                $data = DB::table('rekap_desa_bulanan')
                    ->join('users_mobile as desa', 'rekap_desa_bulanan.id_user', '=', 'desa.id')
                    ->join('subdistrict', 'desa.id_subdistrict', '=', 'subdistrict.id')
                    ->join('village', 'desa.id_village', '=', 'village.id')
                    ->select('rekap_desa_bulanan.*', 'subdistrict.name as nama_kec', 'village.name as nama_desa')
                    ->where('rekap_desa_bulanan.kategori', 'prioritas')
                    ->where('desa.id_role', 1)
                    ->where('desa.id_subdistrict', $user->id_subdistrict)
                    ->where('rekap_desa_bulanan.status', $statusFilter)
                    ->latest('id_rekap_desa_bulanan')
                    ->get();
            }
        }
        $status = $statusFilter;
        return view('backend.prioritas_bulanan', compact('data', 'status'));
    }
}