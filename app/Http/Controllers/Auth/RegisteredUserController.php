<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Menampilkan halaman registrasi
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Menangani request registrasi
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'kecamatan' => ['required', 'string'],
                'desa' => ['required', 'string'],
                'role_bidang' => ['required', 'string'],
            ], [
                'password.confirmed' => 'Konfirmasi password tidak sesuai',
                'email.unique' => 'Email sudah terdaftar',
            ]);
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'kecamatan' => $request->kecamatan,
            'desa' => $request->desa,
            'role_bidang' => $request->role_bidang,
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect(RouteServiceProvider::HOME)
            ->with('success', 'Registrasi berhasil! Silakan verifikasi email Anda');
    }
}