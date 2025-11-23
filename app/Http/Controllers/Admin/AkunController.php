<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Audiens;
use App\Models\Musisi;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AkunController extends Controller
{
    /**
     * Tampilkan daftar semua akun (Admin, Musisi, Audiens).
     */
    public function index(): View
    {
        // Admin
        $admins = User::with('role')
            ->whereHas('role', fn($q) => $q->where('nama_roles', 'Admin'))
            ->orderBy('nama')
            ->get();

        // Musisi approved (aktif)
        $musisiApproved = Musisi::with(['user.role'])
            ->where('status', 'approved')
            ->orderByDesc('approved_at')
            ->get();

        // Musisi pending & rejected -> untuk info jumlah di kartu ringkasan
        $musisiPending  = Musisi::where('status', 'pending')->count();
        $musisiRejected = Musisi::where('status', 'rejected')->count();

        // Audiens
        $audiens = Audiens::with(['user.role'])
            ->orderByDesc('id_audiens')
            ->get();

        return view('admin.daftarAcc', compact(
            'admins',
            'musisiApproved',
            'musisiPending',
            'musisiRejected',
            'audiens'
        ));
    }

    /**
     * Hapus akun user (Musisi / Audiens).
     * Admin TIDAK boleh dihapus lewat sini.
     */
    public function destroy(User $user): RedirectResponse
    {
        // Kalau user ini Admin → jangan dihapus di sini
        if ($user->role && $user->role->nama_roles === 'Admin') {
            return redirect()
                ->route('admin.daftarAcc')
                ->with('error', 'Akun Admin tidak dapat dihapus dari menu ini.');
        }

        // Hapus user -> akan cascade ke musisis / audiens karena FK onDelete('cascade')
        $nama  = $user->nama ?? $user->email;
        $role  = $user->role->nama_roles ?? 'User';

        $user->delete();

        return redirect()
            ->route('admin.daftarAcc')
            ->with('success', "Akun {$role} '{$nama}' berhasil dihapus.");
    }
}
