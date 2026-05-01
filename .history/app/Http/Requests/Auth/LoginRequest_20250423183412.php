<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use App\Models\Pengguna;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

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

        // Cari user/pengguna
        $user = User::where('email', $this->email)
            ->orWhere('nomer_telepon', $this->email)
            ->first();

        $pengguna = Pengguna::where('no_whatsapp', $this->email)->first();

        if (!$user && !$pengguna) {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        // Proses pengecekan password
        if ($user) {
            $this->authenticateUser($user);
        } else {
            $this->authenticatePengguna($pengguna);
        }

        RateLimiter::clear($this->throttleKey());
    }

    protected function authenticateUser($user): void
    {
        if (!Hash::check($this->password, $user->password)) {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                'password' => trans('auth.failed'),
            ]);
        }

        Auth::guard('web')->login($user, $this->boolean('remember'));
        $this->session()->regenerate();
    }

    protected function authenticatePengguna($pengguna): void
    {
        if ($this->password !== $pengguna->password) {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                'password' => trans('auth.failed'),
            ]);
        }

        Auth::guard('pengguna')->login($pengguna, $this->boolean('remember'));
        $this->session()->regenerate();
    }

    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
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
        return Str::transliterate(Str::lower($this->input('email'))) . '|' . $this->ip();
    }
}
