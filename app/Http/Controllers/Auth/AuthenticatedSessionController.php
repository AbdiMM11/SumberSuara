<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function create(): View
    {
        // Arahkan ke view auth/loginuser.blade.php
        return view('auth.loginuser');
    }

    /**
     * Proses permintaan login.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Validasi dasar (email + password) dari LoginRequest
        $data = $request->validated();

        // 1) CARI USER BERDASARKAN EMAIL
        $user = User::where('email', $data['email'])->first();

        if (! $user) {
            // Akun tidak terdaftar
            return back()
                ->withErrors([
                    'email' => 'Akun tidak terdaftar di Sumber Suara.',
                ])
                ->withInput($request->only('email'));
        }

        // 2) CEK PASSWORD
        if (! Hash::check($data['password'], $user->password)) {
            // Password salah → error di field password
            return back()
                ->withErrors([
                    'password' => 'Password yang kamu masukkan salah.',
                ])
                ->withInput($request->only('email'));
        }

        /**
         * 3A) KHUSUS MUSISI: WAJIB status = approved
         * - Kalau belum punya relasi musisi, atau status bukan 'approved'
         *   → blokir login.
         */
        if ($user->roles_id == 2) { // 2 = Musisi
            $musisi = $user->musisi; // relasi dari model User

            if (! $musisi || $musisi->status !== 'approved') {
                return back()
                    ->withErrors([
                        'email' => 'Akun musisi Anda belum disetujui Admin. '
                                 . 'Silakan tunggu proses verifikasi atau hubungi Admin Sumber Suara.',
                    ])
                    ->withInput($request->only('email'));
            }
        }

        /**
         * 3B) CEK STATUS is_active (untuk semua role)
         *    - null  → dianggap aktif (user lama / belum di-set)
         *    - 1/true → aktif
         *    - 0/false → TIDAK boleh login
         */
        $status = $user->is_active ?? null;

        if ($status === 0 || $status === '0' || $status === false) {
            $roleId = $user->roles_id;

            // pesan khusus untuk Musisi non-aktif
            if ($roleId == 2) {
                return back()
                    ->withErrors([
                        'email' => 'Akun musisi Anda belum aktif atau telah ditolak. '
                                 . 'Silakan tunggu proses verifikasi Admin atau hubungi Admin Sumber Suara.',
                    ])
                    ->withInput($request->only('email'));
            }

            // pesan umum untuk akun lain yang non-aktif
            return back()
                ->withErrors([
                    'email' => 'Akun Anda belum aktif. Silakan hubungi Admin untuk aktivasi akun.',
                ])
                ->withInput($request->only('email'));
        }

        // 4) Semua cek lolos → login & regenerate session
        Auth::login($user);
        $request->session()->regenerate();

        // 5) Redirect berdasarkan roles_id
        if ($user->roles_id == 1) {
            // Admin
            return redirect()
                ->intended(route('admin.dashboard'))
                ->with('success', 'Selamat datang Admin!');
        }

        if ($user->roles_id == 2) {
            // Musisi
            return redirect()
                ->intended(route('musisi.dashboard'))
                ->with('success', 'Selamat datang Musisi!');
        }

        if ($user->roles_id == 3) {
            // Audiens
            return redirect()
                ->intended(route('index'))
                ->with('success', 'Selamat datang di Sumber Suara!');
        }

        // Role tidak dikenali → logout & kembali ke halaman login normal
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->withErrors([
                'email' => 'Role akun Anda tidak dikenali.',
            ]);
    }

    /**
     * Logout user.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
