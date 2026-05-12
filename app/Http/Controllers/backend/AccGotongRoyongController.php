<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccGotongRoyongController extends Controller
{
    public function index()
    {
        $got1 = 0;
        $got2 = 0;

        // =====================================
        // WEB KABUPATEN
        // =====================================
        if (Auth::guard('web')->check()) {

            // MENUNGGU ACC KABUPATEN (Hanya melihat yang sudah di-ACC Kecamatan)
            $got1 = DB::table('laporan_gotong_royong')
                ->whereIn('status', ['Disetujui1', 'disetujui1', 'DISETUJUI1'])
                ->count();

            // SUDAH FINAL
            $got2 = DB::table('laporan_gotong_royong')
                ->whereIn('status', ['Disetujui2', 'disetujui2', 'DISETUJUI2'])
                ->count();
        }

        // =====================================
        // WEB KECAMATAN
        // =====================================
        else if (Auth::guard('pengguna')->check()) {

            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) {

                // JURUS ANTI-0: Hapus where('id_role', 1) agar sistem tidak mendiskualifikasi pembuat laporan
                $desaUsers = Pengguna::where(
                        'id_subdistrict',
                        $user->id_subdistrict
                    )
                    ->pluck('id');

                // MENUNGGU PERSETUJUAN (Hanya melihat laporan mentah dari desa)
                $got1 = DB::table('laporan_gotong_royong')
                    ->whereIn('id_user', $desaUsers)
                    ->whereIn('status', ['proses', 'Proses', 'PROSES'])
                    ->count();

                // SUDAH DISETUJUI
                $got2 = DB::table('laporan_gotong_royong')
                    ->whereIn('id_user', $desaUsers)
                    ->whereIn('status', ['Disetujui1', 'disetujui1', 'DISETUJUI1'])
                    ->count();
            }
        }

        return view(
            'backend.accgotongroyong',
            compact('got1', 'got2')
        );
    }
}