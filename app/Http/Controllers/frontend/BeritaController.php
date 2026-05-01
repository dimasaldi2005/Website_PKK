<?php

namespace App\Http\Controllers\frontend;

//import Model "Post
use App\Models\Berita;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use App\Models\Visitor;
use Carbon\Carbon;

class BeritaController extends Controller
{
    // public function index(Request $request){
    //     $keyword = $request->keyword;

    //     $beritas = Berita::where('judul', 'LIKE', '%'.$keyword.'%');
    //     return view('frontend.berita', compact('beritas'));
    // }
    /**
     * index
     *
      * @return View
     */

    public function index(Request $request){
        $today = now()->format('Y-m-d');
        $visitor = Visitor::firstOrNew(['tanggal' => $today]);
        $visitor->count++;
        $visitor->save();
        
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $totalMinggu = Visitor::whereBetween('tanggal', [$startOfWeek, $endOfWeek])
        ->sum('count');
        
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $totalBulan = Visitor::whereBetween('tanggal', [$startOfMonth, $endOfMonth])
        ->sum('count');
        
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();

        $totalTahun = Visitor::whereBetween('tanggal', [$startOfYear, $endOfYear])
        ->sum('count');
        
        $totalVisitors = Visitor::sum('count');
        
        if ($request->has('search')){
            $beritas = Berita::where('judul','LIKE','%' .$request->search.'%')->paginate(3);
        }else{
            $beritas = Berita::latest()->paginate(3);
        }
        
        
        //render view with posts
        return view('frontend.berita', compact('beritas', 'visitor', 'totalMinggu', 'totalBulan', 'totalTahun', 'totalVisitors'));
        
    }
     
    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get post by ID
        $post = Berita::findOrFail($id);

        $today = now()->format('Y-m-d');
        $visitor = Visitor::firstOrNew(['tanggal' => $today]);
        $visitor->count++;
        $visitor->save();
        
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $totalMinggu = Visitor::whereBetween('tanggal', [$startOfWeek, $endOfWeek])
        ->sum('count');
        
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $totalBulan = Visitor::whereBetween('tanggal', [$startOfMonth, $endOfMonth])
        ->sum('count');
        
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();

        $totalTahun = Visitor::whereBetween('tanggal', [$startOfYear, $endOfYear])
        ->sum('count');
        
        $totalVisitors = Visitor::sum('count');
        
        //render view with posts
        return view('frontend.show', compact('visitor', 'totalMinggu', 'totalBulan', 'totalTahun', 'totalVisitors', 'post'));

        

        //render view with post
    }
    // public function index(){
    //     $berita = Berita::get();
    //     return view('frontend.berita', ['tampil' => $berita]);
    // }
}
