<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\Penghayatan;
use App\Models\Pengguna;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccPenghayatanController extends Controller
{
    public function index()
    {
        $peng1 = 0;
        $peng2 = 0;

        // =========================
        // WEB KABUPATEN
        // =========================
        if (Auth::guard('web')->check()) {

            // MENUNGGU ACC KABUPATEN
            $peng1 = Penghayatan::where('status', 'Disetujui1')
                ->count();

            // SUDAH FINAL
            $peng2 = Penghayatan::where('status', 'Disetujui2')
                ->count();
        }

        // =========================
        // WEB KECAMATAN
        // =========================
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
                $peng1 = Penghayatan::whereIn(
                        'id_user',
                        $desaUsers
                    )
                    ->where('status', 'Proses')
                    ->count();

                // SUDAH DISETUJUI
                $peng2 = Penghayatan::whereIn(
                        'id_user',
                        $desaUsers
                    )
                    ->where('status', 'Disetujui1')
                    ->count();
            }
        }

        return view(
            'backend.accpenghayatan',
            compact('peng1', 'peng2')
        );
    }
}