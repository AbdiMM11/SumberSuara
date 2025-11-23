<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Tampilkan form lupa password.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Kirim link reset password ke email user.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
        ]);

        // Kirim link reset password
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            // sukses → kirim pesan status
            return back()->with('status', 'Link reset password telah dikirim ke email kamu.');
        }

        // gagal (misal email tidak terdaftar)
        return back()
            ->withErrors(['email' => 'Email tidak terdaftar di Sumber Suara.'])
            ->withInput($request->only('email'));
    }
}
