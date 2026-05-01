<?php

namespace App\Http\Controllers\backend;

use App\Models\Ttd;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class TTdKetuaController extends Controller
{
    public function index(){
        $data = Ttd::latest()->paginate();
        return view('backend.ttd', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_terang' => 'required',
            'jabatan' => 'required',
            'pokja' => 'required',
        ]);

        Ttd::create([
            'nama_terang' => $request->nama_terang,
            'jabatan' => $request->jabatan,
            'pokja' => $request->pokja,
        ]);

        return redirect()->route('ttdketua.index')->with(['success' => 'Berhasil Menambahkan Tanda Tangan']);
    }

    public function destroy(string $id_ttds)
    {
        $data = Ttd::find($id_ttds);
        $data->delete();
        return redirect()->route('ttdketua.index')->with(['success' => 'Berhasil Menghapus Tanda Tangan']);
    }
}
