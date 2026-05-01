<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use App\Models\Visitor;
use Carbon\Carbon;

class PokjafouController extends Controller
{
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
        
        //render view with posts
        return view('frontend.pokjafou', compact('visitor', 'totalMinggu', 'totalBulan', 'totalTahun', 'totalVisitors'));
}
}