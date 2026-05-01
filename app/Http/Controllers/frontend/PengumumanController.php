<?php

namespace App\Http\Controllers\frontend;

//import Model "Post
use App\Models\Pengumuman;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use App\Models\Visitor;
use Carbon\Carbon;

class PengumumanController extends Controller
{
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
            $pengumumen = Pengumuman::where('judulPengumuman','LIKE','%' .$request->search.'%')->paginate(3);
        }else{
            $pengumumen = Pengumuman::latest()->paginate(3);
        }
        
        
        //render view with posts
        return view('frontend.pengumuman', compact('pengumumen', 'visitor', 'totalMinggu', 'totalBulan', 'totalTahun', 'totalVisitors'));
       
        
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
        $post = Pengumuman::findOrFail($id);

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
        return view('frontend.ehh', compact('visitor', 'totalMinggu', 'totalBulan', 'totalTahun', 'totalVisitors', 'post'));
    }
}
