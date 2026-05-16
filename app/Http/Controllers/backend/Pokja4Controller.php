<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Pokja4Controller extends Controller
{
    public function index()
    {
        $modelPertama = 0;
        $modelKedua = 0;
        $modelKetiga = 0;
        $modelKeempat = 0;
        $modelKelima = 0;
        $modelKeenam = 0;
        $modelKetujuh = 0;
        $modelKedelapan = 0;

        $data = collect();

        /*
        |--------------------------------------------------------------------------
        | STATUS
        |--------------------------------------------------------------------------
        */

        $statusKecamatan = [
            'Proses',
            'proses',
            'PROSES',

            'Disetujui1',
            'disetujui1',
            'DISETUJUI1'
        ];

        $statusDesaKabupaten = [
            'Disetujui1',
            'disetujui1',
            'DISETUJUI1',

            'Disetujui2',
            'disetujui2',
            'DISETUJUI2'
        ];

        $statusKecamatanKabupaten = [
            'Proses',
            'proses',
            'PROSES',

            'Disetujui2',
            'disetujui2',
            'DISETUJUI2'
        ];

        /*
        |--------------------------------------------------------------------------
        | WEB KABUPATEN
        |--------------------------------------------------------------------------
        */

        if (Auth::guard('web')->check()) {

            /*
            |--------------------------------------------------------------------------
            | MODEL 1
            |--------------------------------------------------------------------------
            */

            $modelPertama = DB::table('laporan_bidang_kesehatan')

                ->leftJoin(
                    'users_mobile',
                    'laporan_bidang_kesehatan.id_user',
                    '=',
                    'users_mobile.id'
                )

                ->where(function ($query) use (
                    $statusDesaKabupaten,
                    $statusKecamatanKabupaten
                ) {

                    // DESA
                    $query->where(function ($q) use ($statusDesaKabupaten) {

                        $q->where('users_mobile.id_role', 1)

                            ->whereIn(
                                'laporan_bidang_kesehatan.status',
                                $statusDesaKabupaten
                            );
                    })

                    // KECAMATAN
                    ->orWhere(function ($q) use ($statusKecamatanKabupaten) {

                        $q->where('users_mobile.id_role', 2)

                            ->whereIn(
                                'laporan_bidang_kesehatan.status',
                                $statusKecamatanKabupaten
                            );
                    });
                })

                ->count();

            /*
            |--------------------------------------------------------------------------
            | MODEL 2
            |--------------------------------------------------------------------------
            */

            $modelKedua = DB::table('laporan_kelestarian_lingkungan_hidup')

                ->leftJoin(
                    'users_mobile',
                    'laporan_kelestarian_lingkungan_hidup.id_user',
                    '=',
                    'users_mobile.id'
                )

                ->where(function ($query) use (
                    $statusDesaKabupaten,
                    $statusKecamatanKabupaten
                ) {

                    $query->where(function ($q) use ($statusDesaKabupaten) {

                        $q->where('users_mobile.id_role', 1)

                            ->whereIn(
                                'laporan_kelestarian_lingkungan_hidup.status',
                                $statusDesaKabupaten
                            );
                    })

                    ->orWhere(function ($q) use ($statusKecamatanKabupaten) {

                        $q->where('users_mobile.id_role', 2)

                            ->whereIn(
                                'laporan_kelestarian_lingkungan_hidup.status',
                                $statusKecamatanKabupaten
                            );
                    });
                })

                ->count();

            /*
            |--------------------------------------------------------------------------
            | MODEL 3
            |--------------------------------------------------------------------------
            */

            $modelKetiga = DB::table('laporan_perencanaan_sehat')

                ->leftJoin(
                    'users_mobile',
                    'laporan_perencanaan_sehat.id_user',
                    '=',
                    'users_mobile.id'
                )

                ->where(function ($query) use (
                    $statusDesaKabupaten,
                    $statusKecamatanKabupaten
                ) {

                    $query->where(function ($q) use ($statusDesaKabupaten) {

                        $q->where('users_mobile.id_role', 1)

                            ->whereIn(
                                'laporan_perencanaan_sehat.status',
                                $statusDesaKabupaten
                            );
                    })

                    ->orWhere(function ($q) use ($statusKecamatanKabupaten) {

                        $q->where('users_mobile.id_role', 2)

                            ->whereIn(
                                'laporan_perencanaan_sehat.status',
                                $statusKecamatanKabupaten
                            );
                    });
                })

                ->count();

            /*
            |--------------------------------------------------------------------------
            | MODEL 4
            |--------------------------------------------------------------------------
            */

            $modelKeempat = DB::table('laporan_kader_pokja4')

                ->leftJoin(
                    'users_mobile',
                    'laporan_kader_pokja4.id_user',
                    '=',
                    'users_mobile.id'
                )

                ->where(function ($query) use (
                    $statusDesaKabupaten,
                    $statusKecamatanKabupaten
                ) {

                    $query->where(function ($q) use ($statusDesaKabupaten) {

                        $q->where('users_mobile.id_role', 1)

                            ->whereIn(
                                'laporan_kader_pokja4.status',
                                $statusDesaKabupaten
                            );
                    })

                    ->orWhere(function ($q) use ($statusKecamatanKabupaten) {

                        $q->where('users_mobile.id_role', 2)

                            ->whereIn(
                                'laporan_kader_pokja4.status',
                                $statusKecamatanKabupaten
                            );
                    });
                })

                ->count();

            /*
            |--------------------------------------------------------------------------
            | MODEL 5 = REKAP BULANAN UNGGULAN
            |--------------------------------------------------------------------------
            */

            $modelKelima = DB::table('rekap_desa_bulanan')

                ->leftJoin(
                    'users_mobile',
                    'rekap_desa_bulanan.id_user',
                    '=',
                    'users_mobile.id'
                )

                ->where('rekap_desa_bulanan.kategori', 'unggulan')

                ->where(function ($query) use (
                    $statusDesaKabupaten,
                    $statusKecamatanKabupaten
                ) {

                    // DESA
                    $query->where(function ($q) use ($statusDesaKabupaten) {

                        $q->where('users_mobile.id_role', 1)

                            ->whereIn(
                                'rekap_desa_bulanan.status',
                                $statusDesaKabupaten
                            );
                    })

                    // KECAMATAN
                    ->orWhere(function ($q) use ($statusKecamatanKabupaten) {

                        $q->where('users_mobile.id_role', 2)

                            ->whereIn(
                                'rekap_desa_bulanan.status',
                                $statusKecamatanKabupaten
                            );
                    });
                })

                ->count();

            /*
            |--------------------------------------------------------------------------
            | MODEL 6 = REKAP TAHUNAN UNGGULAN
            |--------------------------------------------------------------------------
            */

            $modelKeenam = DB::table('rekap_desa_tahunan')

                ->leftJoin(
                    'users_mobile',
                    'rekap_desa_tahunan.id_user',
                    '=',
                    'users_mobile.id'
                )

                ->where('rekap_desa_tahunan.kategori', 'unggulan')

                ->where(function ($query) use (
                    $statusDesaKabupaten,
                    $statusKecamatanKabupaten
                ) {

                    // DESA
                    $query->where(function ($q) use ($statusDesaKabupaten) {

                        $q->where('users_mobile.id_role', 1)

                            ->whereIn(
                                'rekap_desa_tahunan.status',
                                $statusDesaKabupaten
                            );
                    })

                    // KECAMATAN
                    ->orWhere(function ($q) use ($statusKecamatanKabupaten) {

                        $q->where('users_mobile.id_role', 2)

                            ->whereIn(
                                'rekap_desa_tahunan.status',
                                $statusKecamatanKabupaten
                            );
                    });
                })

                ->count();

            /*
            |--------------------------------------------------------------------------
            | MODEL 7 = POSYANDU UNGGULAN
            |--------------------------------------------------------------------------
            */

            $modelKetujuh = DB::table('posyandu')

                ->leftJoin(
                    'users_mobile',
                    'posyandu.id_user',
                    '=',
                    'users_mobile.id'
                )

                ->where('posyandu.kategori', 'unggulan')

                ->where(function ($query) use (
                    $statusDesaKabupaten,
                    $statusKecamatanKabupaten
                ) {

                    // DESA
                    $query->where(function ($q) use ($statusDesaKabupaten) {

                        $q->where('users_mobile.id_role', 1)

                            ->whereIn(
                                'posyandu.status',
                                $statusDesaKabupaten
                            );
                    })

                    // KECAMATAN
                    ->orWhere(function ($q) use ($statusKecamatanKabupaten) {

                        $q->where('users_mobile.id_role', 2)

                            ->whereIn(
                                'posyandu.status',
                                $statusKecamatanKabupaten
                            );
                    });
                })

                ->count();

            /*
            |--------------------------------------------------------------------------
            | MODEL 8 = KEGIATAN UNGGULAN
            |--------------------------------------------------------------------------
            */

            $modelKedelapan = DB::table('kegiatan_pokja4')

                ->leftJoin(
                    'users_mobile',
                    'kegiatan_pokja4.id_user',
                    '=',
                    'users_mobile.id'
                )

                ->where('kegiatan_pokja4.kategori', 'unggulan')

                ->where(function ($query) use (
                    $statusDesaKabupaten,
                    $statusKecamatanKabupaten
                ) {

                    // DESA
                    $query->where(function ($q) use ($statusDesaKabupaten) {

                        $q->where('users_mobile.id_role', 1)

                            ->whereIn(
                                'kegiatan_pokja4.status',
                                $statusDesaKabupaten
                            );
                    })

                    // KECAMATAN
                    ->orWhere(function ($q) use ($statusKecamatanKabupaten) {

                        $q->where('users_mobile.id_role', 2)

                            ->whereIn(
                                'kegiatan_pokja4.status',
                                $statusKecamatanKabupaten
                            );
                    });
                })

                ->count();
        }

        /*
        |--------------------------------------------------------------------------
        | WEB KECAMATAN
        |--------------------------------------------------------------------------
        */

        else if (Auth::guard('pengguna')->check()) {

            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) {

                $modelPertama = DB::table('laporan_bidang_kesehatan')
                    ->leftJoin(
                        'users_mobile',
                        'laporan_bidang_kesehatan.id_user',
                        '=',
                        'users_mobile.id'
                    )
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1)
                    ->whereIn(
                        'laporan_bidang_kesehatan.status',
                        $statusKecamatan
                    )
                    ->count();

                $modelKedua = DB::table('laporan_kelestarian_lingkungan_hidup')
                    ->leftJoin(
                        'users_mobile',
                        'laporan_kelestarian_lingkungan_hidup.id_user',
                        '=',
                        'users_mobile.id'
                    )
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1)
                    ->whereIn(
                        'laporan_kelestarian_lingkungan_hidup.status',
                        $statusKecamatan
                    )
                    ->count();

                $modelKetiga = DB::table('laporan_perencanaan_sehat')
                    ->leftJoin(
                        'users_mobile',
                        'laporan_perencanaan_sehat.id_user',
                        '=',
                        'users_mobile.id'
                    )
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1)
                    ->whereIn(
                        'laporan_perencanaan_sehat.status',
                        $statusKecamatan
                    )
                    ->count();

                $modelKeempat = DB::table('laporan_kader_pokja4')
                    ->leftJoin(
                        'users_mobile',
                        'laporan_kader_pokja4.id_user',
                        '=',
                        'users_mobile.id'
                    )
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1)
                    ->whereIn(
                        'laporan_kader_pokja4.status',
                        $statusKecamatan
                    )
                    ->count();

                $modelKelima = DB::table('rekap_desa_bulanan')
                    ->leftJoin(
                        'users_mobile',
                        'rekap_desa_bulanan.id_user',
                        '=',
                        'users_mobile.id'
                    )
                    ->where('rekap_desa_bulanan.kategori', 'unggulan')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1)
                    ->whereIn(
                        'rekap_desa_bulanan.status',
                        $statusKecamatan
                    )
                    ->count();

                $modelKeenam = DB::table('rekap_desa_tahunan')
                    ->leftJoin(
                        'users_mobile',
                        'rekap_desa_tahunan.id_user',
                        '=',
                        'users_mobile.id'
                    )
                    ->where('rekap_desa_tahunan.kategori', 'unggulan')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1)
                    ->whereIn(
                        'rekap_desa_tahunan.status',
                        $statusKecamatan
                    )
                    ->count();

                $modelKetujuh = DB::table('posyandu')
                    ->leftJoin(
                        'users_mobile',
                        'posyandu.id_user',
                        '=',
                        'users_mobile.id'
                    )
                    ->where('posyandu.kategori', 'unggulan')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1)
                    ->whereIn(
                        'posyandu.status',
                        $statusKecamatan
                    )
                    ->count();

                $modelKedelapan = DB::table('kegiatan_pokja4')
                    ->leftJoin(
                        'users_mobile',
                        'kegiatan_pokja4.id_user',
                        '=',
                        'users_mobile.id'
                    )
                    ->where('kegiatan_pokja4.kategori', 'unggulan')
                    ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                    ->where('users_mobile.id_role', 1)
                    ->whereIn(
                        'kegiatan_pokja4.status',
                        $statusKecamatan
                    )
                    ->count();
            }
        }

        return view(
            'backend.pokja4',
            compact(
                'modelPertama',
                'modelKedua',
                'modelKetiga',
                'modelKeempat',
                'modelKelima',
                'modelKeenam',
                'modelKetujuh',
                'modelKedelapan',
                'data'
            )
        );
    }
}