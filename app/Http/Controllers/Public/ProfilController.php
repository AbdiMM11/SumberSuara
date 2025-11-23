<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Musisi;
use App\Models\LaguFavorit;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function show(int $id)
    {
        // Ambil musisi berdasarkan PK id_musisi + relasi profil & user
        // HANYA musisi approved + user aktif yang boleh tampil di publik
        $musisi = Musisi::with(['profil', 'user'])
            ->where('id_musisi', $id)
            ->where('status', 'approved')
            ->whereHas('user', function ($q) {
                $q->where('is_active', true);
            })
            ->firstOrFail();

        // === KARYA MUSISI ===
        // Tidak ada kolom status → semua lagu milik musisi ini tampil
        $songs = $musisi->karyas()
            ->with(['musisi.profil', 'musisi.user'])
            ->orderByDesc('updated_at')
            ->limit(20)
            ->get();

        // === FOTO GALLERY ===
        $profil = $musisi->profil;

        $photos = collect([
                $profil?->foto_pilihan1,
                $profil?->foto_pilihan2,
                $profil?->foto_pilihan3,
            ])
            ->filter()
            ->map(fn ($path) => asset('storage/' . $path))
            ->values();

        // === FAVORITE (untuk update icon love per lagu) ===
        $favoriteIds = [];
        if (Auth::check()) {
            $favoriteIds = LaguFavorit::where('user_id', Auth::id())
                ->pluck('karya_id')
                ->toArray();
        }

        return view('profil', [
            'musisi'      => $musisi,
            'songs'       => $songs,
            'photos'      => $photos,
            'favoriteIds' => $favoriteIds,
        ]);
    }
}
