<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccperencanaanController extends Controller
{
    public function index()
    {
        $per1 = 0;
        $per2 = 0;

        if (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) { // Kecamatan
                $desaUsers = DB::table('users_mobile')
                    ->where('id_subdistrict', $user->id_subdistrict)
                    ->where('id_role', 1)
                    ->pluck('id');

                $per1 = DB::table('laporan_perencanaan_sehat')
                    ->whereIn('id_user', $desaUsers)
                    ->whereIn('status', ['Proses', 'proses'])
                    ->count();

                $per2 = DB::table('laporan_perencanaan_sehat')
                    ->whereIn('id_user', $desaUsers)
                    ->where('status', 'Disetujui1')
                    ->count();
            } else { // Desa
                $per1 = DB::table('laporan_perencanaan_sehat')
                    ->where('id_user', $user->id)
                    ->whereIn('status', ['Proses', 'proses'])
                    ->count();

                $per2 = DB::table('laporan_perencanaan_sehat')
                    ->where('id_user', $user->id)
                    ->where('status', 'Disetujui1')
                    ->count();
            }
        } elseif (Auth::guard('web')->check()) { // Admin Web
            // Admin bisa melihat antrean Proses dan Disetujui1
            $per1 = DB::table('laporan_perencanaan_sehat')
                ->whereIn('status', ['Proses', 'proses', 'Disetujui1'])
                ->count();
                
            $per2 = DB::table('laporan_perencanaan_sehat')
                ->where('status', 'Disetujui2')
                ->count();
        }

        return view('backend.accperencanaan', compact('per1', 'per2'));
    }
}