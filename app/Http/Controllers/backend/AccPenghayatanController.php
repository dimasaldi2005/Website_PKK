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

            // MENUNGGU ACC KABUPATEN (Hanya melihat yang sudah di-ACC Kecamatan)
            $peng1 = Penghayatan::whereIn('status', ['Disetujui1', 'disetujui1', 'DISETUJUI1'])
                ->count();

            // SUDAH FINAL
            $peng2 = Penghayatan::whereIn('status', ['Disetujui2', 'disetujui2', 'DISETUJUI2'])
                ->count();
        }

        // =========================
        // WEB KECAMATAN
        // =========================
        else if (Auth::guard('pengguna')->check()) {

            $user = Auth::guard('pengguna')->user();

            if ($user->id_role == 2) {

                // JURUS ANTI-0: Hapus where('id_role', 1) agar sistem tidak bingung
                $desaUsers = Pengguna::where(
                        'id_subdistrict',
                        $user->id_subdistrict
                    )
                    ->pluck('id');

                // MENUNGGU PERSETUJUAN (Hanya melihat laporan mentah dari desa)
                $peng1 = Penghayatan::whereIn(
                        'id_user',
                        $desaUsers
                    )
                    ->whereIn('status', ['proses', 'Proses', 'PROSES'])
                    ->count();

                // SUDAH DISETUJUI
                $peng2 = Penghayatan::whereIn(
                        'id_user',
                        $desaUsers
                    )
                    ->whereIn('status', ['Disetujui1', 'disetujui1', 'DISETUJUI1'])
                    ->count();
            }
        }

        return view(
            'backend.accpenghayatan',
            compact('peng1', 'peng2')
        );
    }
}   