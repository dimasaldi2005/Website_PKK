<?php

namespace App\Http\Controllers\frontend;

use App\Models\PerencanaanSehat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class TampilsehatController extends Controller
{
    public function index()
    {
        $post = PerencanaanSehat::where('status', 'selesai')->paginate();

        return view('frontend.showhat', compact('post'));
    }
}