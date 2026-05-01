<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        // Redirect berdasarkan siapa yang login
        if (Auth::guard('pengguna')->check()) {
            return redirect()->intended(route('dashboard.pengguna'))
                ->with('success', 'Anda telah berhasil Login sebagai Pengguna!');
        }

        // Default: user biasa (web)
        return redirect()->intended(route('dashboard.user'))
            ->with('success', 'Anda telah berhasil Login!');
    }


    public function destroy(Request $request): RedirectResponse
    {
        // Logout dari guard yang aktif
        Auth::guard('web')->logout();
        Auth::guard('pengguna')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/home')->with('success', 'Anda telah berhasil keluar!');
    }
}
