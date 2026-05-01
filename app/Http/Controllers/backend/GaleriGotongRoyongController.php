<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\Galeri;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class GaleriGotongRoyongController extends Controller
{
    public function index(){
     
        $data = Galeri::where('bidang', 'Gotong Royong')
                  ->whereIn('status', ['Upload', 'Proses'])
                  ->get();
        return view('backend.galerigotongroyong', compact('data'));
    }

    public function edit(string $id)
    {
        $data = Galeri::find($id);
        return view('backend.tampil_galerigotongroyong', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $data = Galeri::find($id);
            $data->update([
                'deskripsi' => $request->deskripsi,
                'tanggal' => $request->tanggal,
                'status' => 'Upload',
            ]);
        return redirect()->route('galerigotongroyong.index')->with(['success' => 'Berhasil Menambahkan Galeri']);
    }
    
    public function destroy($id)
    {
        $data = Galeri::findOrFail($id);

        // Ganti dengan path sesuai lokasi file kamu
        $filePath = public_path('frontend2/gallery2/' . $data->gambar);

        if (File::exists($filePath)) {
            File::delete($filePath);
        }
        $data->delete();

        return redirect()->route('galerigotongroyong.index')->with(['success' => 'Berhasil Menghapus Gambar dalam Galeri']);    
    }

}