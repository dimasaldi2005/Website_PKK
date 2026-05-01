<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use App\Models\Pengguna; // Tambah model Pengguna
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    // Update validasi: email tidak harus format email
    public function rules(): array
    {
        return [
            'email' => ['required', 'string'], // Hapus validasi 'email'
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    // Update pesan error
    public function messages(): array
    {
        return [
            'email.required' => 'Harap lengkapi email atau nomor WhatsApp',
            'password.required' => 'Harap lengkapi kata sandi anda',
            'password.min' => 'Kata sandi minimal :min karakter',
        ];
    }

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // Cari user/pengguna berdasarkan email/no_whatsapp
        $user = User::where('email', $this->email)->first();
        $pengguna = Pengguna::where('no_whatsapp', $this->email)->first();

        // Jika tidak ada di kedua tabel
        if (!$user && !$pengguna) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        // Proses pengecekan password
        if ($user) {
            $this->checkUserPassword($user);
        } else {
            $this->checkPenggunaPassword($pengguna);
        }

        RateLimiter::clear($this->throttleKey());
    }

    // Cek password untuk User
    protected function checkUserPassword($user): void
    {
        if (!Hash::check($this->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => trans('auth.failed'),
            ]);
        }

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        $this->session()->regenerate();
    }

    // Cek password untuk Pengguna
    protected function checkPenggunaPassword($pengguna): void
    {
        // Password disimpan sebagai plain text, lakukan perbandingan langsung
        if ($this->password !== $pengguna->password) {
            throw ValidationException::withMessages([
                'password' => trans('auth.failed'),
            ]);
        }

        // Login manual untuk Pengguna dengan guard 'pengguna'
        Auth::guard('pengguna')->login($pengguna, $this->boolean('remember'));
        $this->session()->regenerate();

        Log::info('Session status', [
            'pengguna' => Auth::guard('pengguna')->check(),
            'default' => Auth::check(),
            'pengguna_id' => Auth::guard('pengguna')->id(),
        ]);
    }

    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')) . '|' . $this->ip());
    }
}
