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

            // MENUNGGU ACC KABUPATEN
            $got1 = DB::table('laporan_gotong_royong')
                ->where('status', 'Disetujui1')
                ->count();

            // SUDAH FINAL
            $got2 = DB::table('laporan_gotong_royong')
                ->where('status', 'Disetujui2')
                ->count();
        }

        // =====================================
        // WEB KECAMATAN
        // =====================================
        else if (Auth::guard('pengguna')->check()) {

            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) {

                $desaUsers = Pengguna::where(
                        'id_subdistrict',
                        $user->id_subdistrict
                    )
                    ->where('id_role', 1)
                    ->pluck('id');

                // MENUNGGU PERSETUJUAN
                $got1 = DB::table('laporan_gotong_royong')
                    ->whereIn('id_user', $desaUsers)
                    ->where('status', 'Proses')
                    ->count();

                // SUDAH DISETUJUI
                $got2 = DB::table('laporan_gotong_royong')
                    ->whereIn('id_user', $desaUsers)
                    ->where('status', 'Disetujui1')
                    ->count();
            }
        }

        return view(
            'backend.accgotongroyong',
            compact('got1', 'got2')
        );
    }
}