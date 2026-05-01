<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function update(Request $request, string $id)
    {
        // Tentukan user berdasarkan guard yang aktif
        if (Auth::guard('pengguna')->check()) {
            $user = Pengguna::findOrFail($id);
        } else {
            $user = User::findOrFail($id);
        }

        // Validasi password
        if (!Hash::check($request->currentPassword, $user->password)) {
            return back()->with('error', 'Kata sandi saat ini tidak sesuai');
        }

        if ($request->newpassword != $request->renewpassword) {
            return back()->with('error', 'Konfirmasi kata sandi tidak sesuai');
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->newpassword)
        ]);

        return redirect()->route('profile.index')->with('success', 'Kata sandi berhasil diubah');
    }
}