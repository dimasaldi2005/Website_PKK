<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\Penghayatan;
use App\Models\GotongRoyong;
use App\Models\LaporanPokja1;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengguna;

class Pokja1Controller extends Controller
{
    public function index()
    {
        // Cek guard yang aktif
        if (Auth::guard('pengguna')->check()) {
            $user = Auth::guard('pengguna')->user();

            // Jika pengguna adalah kecamatan (role 2)
            if ($user->id_role == 2) {
                // Ambil data desa (role 1) di kecamatan yang sama
                $desaIds = Pengguna::where('id_subdistrict', $user->id_subdistrict)
                    ->where('id_role', 1)
                    ->pluck('id');

                // Hitung data penghayatan dari desa-desa tersebut
                $modelPertama = Penghayatan::whereIn('id_user', $desaIds)
                    ->whereIn('status', ['Proses', 'Disetujui1'])
                    ->count();

                $modelKedua = GotongRoyong::whereIn('id_user', $desaIds)
                    ->whereIn('status', ['Proses', 'Disetujui1'])
                    ->count();

                $modelKetiga = LaporanPokja1::whereIn('id_user', $desaIds)
                    ->whereIn('status', ['Proses', 'Disetujui1'])
                    ->count();
            }
        } else {
            // Jika guard web - tampilkan data Disetujui1 dan Disetujui2
            $modelPertama = Penghayatan::whereIn('status', ['Disetujui1', 'Disetujui2'])->count();
            $modelKedua = GotongRoyong::whereIn('status', ['Disetujui1', 'Disetujui2'])->count();
            $modelKetiga = LaporanPokja1::whereIn('status', ['Disetujui1', 'Disetujui2'])->count();
        }

        return view('backend.pokja1', compact('modelPertama', 'modelKedua', 'modelKetiga'));
    }
}
