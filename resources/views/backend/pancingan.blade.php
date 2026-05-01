<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\Galeri;
use App\Http\Controllers\Controller;

class Galeri1Controller extends Controller
{
    public function index(){
        $data = Galeri::where('status', 'proses')
        ->get();
        return view('backend.galeripokja1', compact('data'));
    }

    public function edit(string $id)
    {
        $data = Galeri::find($id);
        return view('backend.tampil_galeri', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $data = Galeri::find($id);
            $data->update([
                'judul' => $request->judul,
                'status' => 'upload',
            ]);
        return redirect()->route('galeripokja1.index')->with(['success' => 'Berhasil Menambahkan Galeri']);
    }
    
    public function destroy(string $id)
    {
        
        $data = Galeri::find($id);

        $data->delete();

        return redirect()->route('galeripokja1.index')->with(['success' => 'Berhasil Menghapus Galeri']);
    }

}
