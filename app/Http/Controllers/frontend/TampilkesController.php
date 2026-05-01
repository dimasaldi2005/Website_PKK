<?php

namespace App\Http\Controllers\frontend;

use App\Models\Kesehatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class TampilkesController extends Controller
{
    public function index()
    {
        $post = Kesehatan::where('status', 'selesai')->paginate();

        return view('frontend.showkes', compact('post'));
    }

}