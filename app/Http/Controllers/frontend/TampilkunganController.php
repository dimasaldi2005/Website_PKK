<?php

namespace App\Http\Controllers\frontend;

use App\Models\KelestarianLingkunganHidup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class TampilkunganController extends Controller
{
    public function index()
    {
        $post = KelestarianLingkunganHidup::where('status', 'selesai')->paginate();

        return view('frontend.showling', compact('post'));
    }

}