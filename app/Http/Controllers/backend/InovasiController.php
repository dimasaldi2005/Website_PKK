<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class InovasiController extends Controller
{
    public function index()
    {
        $modelKelima = DB::table('inovasi')->count();

        $data = DB::table('inovasi')->get();

        return view('backend.inovasi', compact(
            'data',
            'modelKelima'
        ));
    }
}