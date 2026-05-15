<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use App\Models\BidangUmum;
use App\Models\GotongRoyong;
use App\Models\Penghayatan;
use App\Models\Pendidikan;
use App\Models\Pengembangan;
use App\Models\Pangan;
use App\Models\Sandang;
use App\Models\Perumahan;
use App\Models\LaporanPokja1;
use App\Models\LaporanPokja3;
use App\Models\LaporanPokja4;
use App\Models\Kesehatan;
use App\Models\Inovasi;
use App\Models\KelestarianLingkunganHidup;
use App\Models\PerencanaanSehat;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        // =========================================
        // JUMLAH USER
        // =========================================

        if (Auth::guard('pengguna')->check()) {

            $loggedInUser = Auth::guard('pengguna')->user();

            // KECAMATAN
            if ($loggedInUser->id_role == 2) {

                $jmlh_user = Pengguna::where('id_role', 1)
                    ->where(
                        'id_subdistrict',
                        $loggedInUser->id_subdistrict
                    )
                    ->count();
            } else {

                // DESA
                $jmlh_user = 1;
            }
        } else {

            // WEB KABUPATEN
            $jmlh_user = Pengguna::count();
        }

        // =========================================
        // FILTER QUERY
        // =========================================

        $getFilteredQuery = function ($model) {

            // =====================================
            // WEB KECAMATAN
            // =====================================

            if (Auth::guard('pengguna')->check()) {

                $user = Auth::guard('pengguna')->user();

                // ROLE KECAMATAN
                if ($user->id_role == 2) {

                    return $model
                        ->leftJoin(
                            'users_mobile',
                            $model->getTable() . '.id_user',
                            '=',
                            'users_mobile.id'
                        )
                        ->where('users_mobile.id_subdistrict', $user->id_subdistrict)
                        // HANYA LAPORAN DESA
                        ->where('users_mobile.id_role', 1)
                        ->where(function ($query) use ($model) {
                            $query->where($model->getTable() . '.status', 'Proses')
                                ->orWhere($model->getTable() . '.status', 'Disetujui1');
                        });
                }
            }

            // =====================================
            // WEB KABUPATEN
            // =====================================

            return $model
                ->leftJoin(
                    'users_mobile',
                    $model->getTable() . '.id_user',
                    '=',
                    'users_mobile.id'
                )

                ->where(function ($query) use ($model) {

                    // LAPORAN DESA
                    $query->where(function ($q) use ($model) {

                        $q->where('users_mobile.id_role', 1)

                            ->where(function ($qq) use ($model) {

                                $qq->where($model->getTable() . '.status', 'Disetujui1')
                                    ->orWhere($model->getTable() . '.status', 'Disetujui2');
                            });
                    })

                        // LAPORAN MOBILE KECAMATAN
                        ->orWhere(function ($q) use ($model) {

                            $q->where('users_mobile.id_role', 2)
                                ->whereIn(
                                    $model->getTable() . '.status',
                                    ['Proses', 'Disetujui1','Disetujui2']
                                );
                        });
                });
        };

        // =========================================
        // BIDANG UMUM
        // =========================================

        $bidangumum = $getFilteredQuery(new BidangUmum())->count();

        // =========================================
        // POKJA 1
        // =========================================

        $bidang11 = $getFilteredQuery(new GotongRoyong())->count();
        $bidang12 = $getFilteredQuery(new Penghayatan())->count();
        $laporan1 = $getFilteredQuery(new LaporanPokja1())->count();

        $totalbidang1 =
            $bidang11 +
            $bidang12 +
            $laporan1;

        // =========================================
        // POKJA 2
        // =========================================

        $bidang21 = $getFilteredQuery(new Pendidikan())->count();
        $bidang22 = $getFilteredQuery(new Pengembangan())->count();

        $totalbidang2 =
            $bidang21 +
            $bidang22;

        // =========================================
        // POKJA 3
        // =========================================

        $bidang31 = $getFilteredQuery(new Pangan())->count();
        $bidang32 = $getFilteredQuery(new Sandang())->count();
        $bidang33 = $getFilteredQuery(new Perumahan())->count();
        $laporan3 = $getFilteredQuery(new LaporanPokja3())->count();

        $totalbidang3 =
            $bidang31 +
            $bidang32 +
            $bidang33 +
            $laporan3;

        // =========================================
        // POKJA 4
        // =========================================

        $bidang41 = $getFilteredQuery(new Kesehatan())->count();

        $bidang42 = $getFilteredQuery(
            new KelestarianLingkunganHidup()
        )->count();

        $bidang43 = $getFilteredQuery(
            new PerencanaanSehat()
        )->count();

        $laporan4 = $getFilteredQuery(
            new LaporanPokja4()
        )->count();
        
        $laporan44 = $getFilteredQuery(
            new Inovasi()
        )->count();

        $totalbidang4 =
            $bidang41 +
            $bidang42 +
            $bidang43 +
            $laporan44 +
            $laporan4 ;

        return view(
            'backend.dashboard',
            compact(
                'jmlh_user',
                'bidangumum',
                'totalbidang1',
                'totalbidang2',
                'totalbidang3',
                'totalbidang4'
            )
        );
    }
}
