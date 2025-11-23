<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Tampilkan form reset password (dari link email).
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', [
            'request' => $request,
        ]);
    }

    /**
     * Simpan password baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token'                 => ['required'],
            'email'                 => ['required', 'email'],
            'password'              => ['required', 'confirmed', 'min:8'],
        ], [
            'email.required'        => 'Email wajib diisi.',
            'email.email'           => 'Format email tidak valid.',
            'password.required'     => 'Password baru wajib diisi.',
            'password.confirmed'    => 'Konfirmasi password baru tidak cocok.',
            'password.min'          => 'Password baru minimal 8 karakter.',
        ]);

        // Proses reset password bawaan Laravel
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password'       => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            // Berhasil reset → arahkan ke login dengan pesan sukses
            return redirect()
                ->route('login')
                ->with('status', 'Password berhasil direset. Silakan login dengan password baru.');
        }

        // Gagal (token invalid/expired dll.)
        return back()
            ->withErrors(['email' => 'Link reset password tidak valid atau sudah kedaluwarsa.'])
            ->withInput($request->only('email'));
    }
}
