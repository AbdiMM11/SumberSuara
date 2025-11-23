<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\MusisiApprovedMail;
use App\Mail\MusisiRejectedMail;
use App\Models\Musisi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class VerifikasiMusisiController extends Controller
{
    /**
     * Tampilkan daftar musisi yang statusnya "pending".
     * View: resources/views/admin/verifikasi.blade.php
     */
    public function index(): View
    {
        $musisis = Musisi::with('user')
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('admin.verifikasi', compact('musisis'));
    }

    /**
     * Setujui pendaftaran musisi.
     * - musisis.status  = approved
     * - musisis.approved_at = now()
     * - users.is_active = true
     * - kirim email MusisiApprovedMail
     */
    public function approve(Request $request, Musisi $musisi): RedirectResponse
    {
        if ($musisi->isApproved()) {
            return back()->with('info', 'Musisi ini sudah disetujui sebelumnya.');
        }

        // Update status musisi
        $musisi->update([
            'status'      => 'approved',
            'approved_at' => now(),
        ]);

        // Aktifkan akun user
        $user = $musisi->user;
        if ($user) {
            $user->update(['is_active' => true]);

            // Kirim email notifikasi
            Mail::to($user->email)->send(new MusisiApprovedMail($musisi));
        }

        return back()->with('success', 'Pendaftaran musisi berhasil disetujui dan akun sudah diaktifkan.');
    }

    /**
     * Tolak pendaftaran musisi.
     * - Kirim email MusisiRejectedMail
     * - Hapus user → cascade delete ke musisis, profil, karyas
     */
    public function reject(Request $request, Musisi $musisi): RedirectResponse
    {
        // Ambil user sebelum dihapus
        $user = $musisi->user;

        // Kalau tidak ada user (data nyangkut), cukup hapus musisinya
        if (! $user) {
            $musisi->delete();

            return back()->with('success', 'Pendaftaran musisi telah ditolak dan data musisi sudah dihapus.');
        }

        // Kirim email penolakan dulu, sebelum data dihapus
        Mail::to($user->email)->send(new MusisiRejectedMail($musisi));

        // Hapus user → otomatis menghapus musisi + profil + karya (karena cascadeOnDelete di migration)
        $user->delete();

        return back()->with('success', 'Pendaftaran musisi ditolak, email notifikasi dikirim, dan seluruh data musisi telah dihapus.');
    }
}
