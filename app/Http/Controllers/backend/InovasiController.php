<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class InovasiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN INOVASI
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $prioritas = DB::table('rekap_desa_bulanan')
            ->where('kategori', 'prioritas')
            ->count();

        $unggulan = DB::table('rekap_desa_bulanan')
            ->where('kategori', 'Unggulan')
            ->count();

        return view('backend.inovasi', compact(
            'prioritas',
            'unggulan'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | HALAMAN PRIORITAS
    |--------------------------------------------------------------------------
    */

    public function prioritas()
    {
        $bulanan = DB::table('rekap_desa_bulanan')
            ->where('kategori', 'prioritas')
            ->count();

        $tahunan = 0;
        $posyandu = 0;
        $kegiatan = 0;

        return view('backend.prioritas', compact(
            'bulanan',
            'tahunan',
            'posyandu',
            'kegiatan'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | HALAMAN UNGGULAN
    |--------------------------------------------------------------------------
    */

    public function unggulan()
    {
        $bulanan = DB::table('rekap_desa_bulanan')
            ->where('kategori', 'Unggulan')
            ->count();

        $tahunan = 0;
        $posyandu = 0;
        $kegiatan = 0;

        return view('backend.unggulan', compact(
            'bulanan',
            'tahunan',
            'posyandu',
            'kegiatan'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | REKAP BULANAN UNGGULAN
    |--------------------------------------------------------------------------
    */

    public function unggulanBulanan(Request $request)
    {
        $data = collect();

        /*
    |--------------------------------------------------------------------------
    | ADMIN WEB KABUPATEN
    |--------------------------------------------------------------------------
    */

        if (Auth::guard('web')->check()) {

            $query = DB::table('rekap_desa_bulanan')
                ->join(
                    'users_mobile',
                    'rekap_desa_bulanan.id_user',
                    '=',
                    'users_mobile.id'
                )
                ->join(
                    'subdistrict',
                    'users_mobile.id_subdistrict',
                    '=',
                    'subdistrict.id'
                )
                ->join(
                    'village',
                    'users_mobile.id_village',
                    '=',
                    'village.id'
                )
                ->select(
                    'rekap_desa_bulanan.*',
                    'subdistrict.name as nama_kec',
                    'village.name as nama_desa'
                )
                ->where(
                    'rekap_desa_bulanan.kategori',
                    'Unggulan'
                );

            /*
        |--------------------------------------------------------------------------
        | DEFAULT STATUS
        |--------------------------------------------------------------------------
        */

            $status = $request->status ?? 'Disetujui1';

            /*
        |--------------------------------------------------------------------------
        | FILTER STATUS
        |--------------------------------------------------------------------------
        */

            $query->where(
                'rekap_desa_bulanan.status',
                $status
            );

            $data = $query
                ->latest('id_rekap_desa_bulanan')
                ->get();
        }

        /*
    |--------------------------------------------------------------------------
    | USER KECAMATAN
    |--------------------------------------------------------------------------
    */ elseif (Auth::guard('pengguna')->check()) {

            $user = Auth::guard('pengguna')->user();

            /*
        |--------------------------------------------------------------------------
        | ROLE KECAMATAN
        |--------------------------------------------------------------------------
        */

            if ($user->id_role == 2) {

                $query = DB::table('rekap_desa_bulanan')
                    ->join(
                        'users_mobile as desa',
                        'rekap_desa_bulanan.id_user',
                        '=',
                        'desa.id'
                    )
                    ->join(
                        'subdistrict',
                        'desa.id_subdistrict',
                        '=',
                        'subdistrict.id'
                    )
                    ->join(
                        'village',
                        'desa.id_village',
                        '=',
                        'village.id'
                    )
                    ->select(
                        'rekap_desa_bulanan.*',
                        'subdistrict.name as nama_kec',
                        'village.name as nama_desa'
                    )
                    ->where(
                        'rekap_desa_bulanan.kategori',
                        'Unggulan'
                    )
                    ->where(
                        'desa.id_role',
                        1
                    )
                    ->where(
                        'desa.id_subdistrict',
                        $user->id_subdistrict
                    );

                /*
            |--------------------------------------------------------------------------
            | DEFAULT STATUS KECAMATAN
            |--------------------------------------------------------------------------
            */

                $status = $request->status ?? 'Proses';

                /*
            |--------------------------------------------------------------------------
            | FILTER STATUS
            |--------------------------------------------------------------------------
            */

                $query->where(
                    'rekap_desa_bulanan.status',
                    $status
                );

                $data = $query
                    ->latest('id_rekap_desa_bulanan')
                    ->get();
            }
        }

        return view(
            'backend.unggulan_bulanan',
            compact(
                'data',
                'status'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | REKAP BULANAN PRIORITAS
    |--------------------------------------------------------------------------
    */

    public function prioritasBulanan(Request $request)
    {
        $data = collect();

        // =========================
        // ADMIN WEB
        // =========================
        if (Auth::guard('web')->check()) {

            $query = DB::table('rekap_desa_bulanan')
                ->join(
                    'users_mobile',
                    'rekap_desa_bulanan.id_user',
                    '=',
                    'users_mobile.id'
                )
                ->join(
                    'subdistrict',
                    'users_mobile.id_subdistrict',
                    '=',
                    'subdistrict.id'
                )
                ->join(
                    'village',
                    'users_mobile.id_village',
                    '=',
                    'village.id'
                )
                ->select(
                    'rekap_desa_bulanan.*',
                    'subdistrict.name as nama_kec',
                    'village.name as nama_desa'
                )
                ->where(
                    'rekap_desa_bulanan.kategori',
                    'prioritas'
                );

            // FILTER STATUS
            if ($request->status != '') {

                $query->where(
                    'rekap_desa_bulanan.status',
                    $request->status
                );
            }

            $data = $query
                ->latest('id_rekap_desa_bulanan')
                ->get();
        }

        // =========================
        // USER KECAMATAN
        // =========================
        elseif (Auth::guard('pengguna')->check()) {

            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) {

                $query = DB::table('rekap_desa_bulanan')
                    ->join(
                        'users_mobile as desa',
                        'rekap_desa_bulanan.id_user',
                        '=',
                        'desa.id'
                    )
                    ->join(
                        'subdistrict',
                        'desa.id_subdistrict',
                        '=',
                        'subdistrict.id'
                    )
                    ->join(
                        'village',
                        'desa.id_village',
                        '=',
                        'village.id'
                    )
                    ->select(
                        'rekap_desa_bulanan.*',
                        'subdistrict.name as nama_kec',
                        'village.name as nama_desa'
                    )
                    ->where(
                        'rekap_desa_bulanan.kategori',
                        'prioritas'
                    )
                    ->where(
                        'desa.id_role',
                        1
                    )
                    ->where(
                        'desa.id_subdistrict',
                        $user->id_subdistrict
                    );

                // FILTER STATUS
                if ($request->status != '') {

                    $query->where(
                        'rekap_desa_bulanan.status',
                        $request->status
                    );
                }

                $data = $query
                    ->latest('id_rekap_desa_bulanan')
                    ->get();
            }
        }

        return view(
            'backend.prioritas_bulanan',
            compact('data')
        );
    }
}
