<?php

namespace App\Http\Controllers\backend;

use App\Models\Ttds;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class TTdWakilKetuaController extends Controller
{
    public function index(){
        $data = Ttds::latest()->paginate();
        return view('backend.ttdwakilketua', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_terang' => 'required',
            'jabatan' => 'required',
        ]);

        Ttds::create([
            'nama_terang' => $request->nama_terang,
            'jabatan' => $request->jabatan,
        ]);

        return redirect()->route('ttdwakilketua.index')->with(['success' => 'Berhasil Menambahkan Tanda Tangan']);
    }

    public function destroy(string $id_ttds)
    {
        $data = Ttds::find($id_ttds);
        $data->delete();
        return redirect()->route('ttdwakilketua.index')->with(['success' => 'Berhasil Menghapus Tanda Tangan']);
    }
}
