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

        // Periksa guard yang digunakan untuk login
        if (Auth::guard('pengguna')->check()) {
            return redirect()->intended(RouteServiceProvider::PENGGUNA_HOME)
                ->with('success', 'Anda telah berhasil Login sebagai Pengguna!');
        }

        return redirect()->intended(RouteServiceProvider::HOME)
            ->with('success', 'Anda telah berhasil Login sebagai User!');
    }

    public function destroy(Request $request): RedirectResponse
    {
        // Logout dari semua guard
        Auth::guard('web')->logout();
        Auth::guard('pengguna')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil keluar!');
    }
}
