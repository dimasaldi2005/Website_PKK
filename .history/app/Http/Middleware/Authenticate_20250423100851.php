<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            // Periksa route yang diminta untuk menentukan redirect yang sesuai
            if ($request->is('pengguna/*')) {
                return route('login', ['guard' => 'pengguna']);
            }
            return route('login');
        }
        return null;
    }
}
