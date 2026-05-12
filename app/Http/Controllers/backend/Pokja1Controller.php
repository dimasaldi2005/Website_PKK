<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Pokja1Controller extends Controller
{
    public function index()
    {
        $modelPertama = 0;
        $modelKedua = 0;
        $modelKetiga = 0;

        // =====================================
        // WEB KABUPATEN
        // =====================================
        if (Auth::guard('web')->check()) {

            // LAPORAN MASUK KABUPATEN
            $statusAdmin = ['Disetujui1', 'Disetujui2'];

            // PENGHAYATAN DAN PENGAMALAN
            $modelPertama = DB::table('laporan_penghayatan_n_pengamalan')
                ->whereIn(
                    'laporan_penghayatan_n_pengamalan.status',
                    $statusAdmin
                )
                ->count();

            // GOTONG ROYONG
            $modelKedua = DB::table('laporan_gotong_royong')
                ->whereIn(
                    'laporan_gotong_royong.status',
                    $statusAdmin
                )
                ->count();

            // KADER POKJA 1
            $modelKetiga = DB::table('laporan_kader_pokja1')
                ->whereIn(
                    'laporan_kader_pokja1.status',
                    $statusAdmin
                )
                ->count();
        }

        // =====================================
        // WEB KECAMATAN
        // =====================================
        else if (Auth::guard('pengguna')->check()) {

            $user = Auth::guard('pengguna')->user();

            // ROLE KECAMATAN
            if ($user->id_role == 2) {

                // LAPORAN DESA
                $statusKecamatan = ['Proses', 'Disetujui1'];

                // PENGHAYATAN DAN PENGAMALAN
                $modelPertama = DB::table('laporan_penghayatan_n_pengamalan')
                    ->leftJoin(
                        'users_mobile',
                        'laporan_penghayatan_n_pengamalan.id_user',
                        '=',
                        'users_mobile.id'
                    )
                    ->where(
                        'users_mobile.id_subdistrict',
                        $user->id_subdistrict
                    )
                    ->where('users_mobile.id_role', 1)
                    ->whereIn(
                        'laporan_penghayatan_n_pengamalan.status',
                        $statusKecamatan
                    )
                    ->count();

                // GOTONG ROYONG
                $modelKedua = DB::table('laporan_gotong_royong')
                    ->leftJoin(
                        'users_mobile',
                        'laporan_gotong_royong.id_user',
                        '=',
                        'users_mobile.id'
                    )
                    ->where(
                        'users_mobile.id_subdistrict',
                        $user->id_subdistrict
                    )
                    ->where('users_mobile.id_role', 1)
                    ->whereIn(
                        'laporan_gotong_royong.status',
                        $statusKecamatan
                    )
                    ->count();

                // KADER POKJA 1
                $modelKetiga = DB::table('laporan_kader_pokja1')
                    ->leftJoin(
                        'users_mobile',
                        'laporan_kader_pokja1.id_user',
                        '=',
                        'users_mobile.id'
                    )
                    ->where(
                        'users_mobile.id_subdistrict',
                        $user->id_subdistrict
                    )
                    ->where('users_mobile.id_role', 1)
                    ->whereIn(
                        'laporan_kader_pokja1.status',
                        $statusKecamatan
                    )
                    ->count();
            }
        }

        return view(
            'backend.pokja1',
            compact(
                'modelPertama',
                'modelKedua',
                'modelKetiga'
            )
        );
    }

    public function filter(Request $request)
    {
        /* Kode asli */
    }

    public function cetak(Request $request)
    {
        /* Kode asli */
    }
}