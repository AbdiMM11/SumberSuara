<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    /**
     * Simpan komentar baru pada sebuah artikel.
     * Hanya bisa diakses oleh user yang sudah login (sudah dijaga di route).
     */
    public function store(Request $request, string $slug)
    {
        // Cari artikel berdasarkan slug
        // Kalau mau hanya artikel yang sudah published:
        // $artikel = Artikel::published()->where('slug', $slug)->firstOrFail();
        $artikel = Artikel::where('slug', $slug)->firstOrFail();

        // Validasi input komentar
        $data = $request->validate([
            'isi' => ['required', 'string', 'min:3'],
        ]);

        // Simpan komentar
        Komentar::create([
            'artikel_id' => $artikel->id_artikel,
            'user_id'    => Auth::id(),
            'isi'        => $data['isi'],
        ]);

        return back()->with('success', 'Komentar berhasil dikirim.');
    }

    /**
     * Hapus komentar.
     * Hanya boleh oleh:
     * - Pemilik komentar, atau
     * - User dengan role Admin
     */
    public function destroy(int $id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $komentar = Komentar::findOrFail($id);

        // pemilik komentar
        $isOwner = $komentar->user_id === $user->id;

        // admin → cek langsung via relasi role
        $isAdmin = $user->role?->nama_roles === 'Admin';

        if (! $isOwner && ! $isAdmin) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus komentar ini.');
        }

        $komentar->delete();

        return back()->with('success', 'Komentar berhasil dihapus.');
    }
}
