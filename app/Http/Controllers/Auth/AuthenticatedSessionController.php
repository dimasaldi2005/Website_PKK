<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi input form
        $request->validate([
            'email' => ['required', 'string'], // Asumsi nama input di HTML komandan tetap 'email'
            'password' => ['required', 'string'],
        ]);

        $loginId = $request->input('email');
        $password = $request->input('password');
        $remember = $request->boolean('remember');

        // 2. Coba login sebagai Admin (Guard 'web' -> tabel 'users')
        if (Auth::guard('web')->attempt(['email' => $loginId, 'password' => $password], $remember)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        // 3. Coba login sebagai Kecamatan/Desa (Guard 'pengguna' -> tabel 'users_mobile')
        // PERHATIKAN: Sekarang kita menggunakan kolom 'phone_number' sesuai database!
        if (Auth::guard('pengguna')->attempt(['phone_number' => $loginId, 'password' => $password], $remember)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        // 4. Jika gagal login karena salah password atau akun tidak terdaftar
        throw \Illuminate\Validation\ValidationException::withMessages([
            'email' => 'Email / Nomor WhatsApp atau password salah.',
        ]);
    }

    public function destroy(Request $request)
    {
        // 1. Pastikan kedua guard benar-benar di-logout (Gembok ditutup!)
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        if (Auth::guard('pengguna')->check()) {
            Auth::guard('pengguna')->logout();
        }

        // 2. Hancurkan sisa-sisa sesi di browser
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // 3. Lempar ke halaman Home dengan Pop-up SweetAlert
        return redirect('/home')->with('success', 'Sampai jumpa! Anda telah aman keluar dari sistem E-PKK.');
    }
}
