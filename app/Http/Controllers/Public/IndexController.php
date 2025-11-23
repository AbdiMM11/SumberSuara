<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use App\Models\Musisi;
use App\Models\Karya;
use App\Models\LaguFavorit;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | PARAMETER UNTUK GRID MUSISI (BLUE SEARCH BAR)
        |   - q_musisi, genre_musisi, domisili_musisi (pakai name lama: q, genre, domisili)
        |--------------------------------------------------------------------------
        */
        $qMusisi       = trim((string) $request->input('q', ''));
        $genreMusisi   = (string) $request->input('genre', '');
        $domisiliMusisi = (string) $request->input('domisili', '');

        /*
        |--------------------------------------------------------------------------
        | PARAMETER UNTUK PLAYLIST LAGU SIDEBAR
        |   - hanya q_song + genre_song
        |   - TIDAK mempengaruhi grid musisi
        |--------------------------------------------------------------------------
        */
        $qSong     = trim((string) $request->input('q_song', ''));
        $genreSong = (string) $request->input('genre_song', '');

        /*
        |--------------------------------------------------------------------------
        | GRID MUSISI (HANYA APPROVED + USER AKTIF)
        |--------------------------------------------------------------------------
        */
        $musisiQuery = Musisi::query()
            ->with(['profil', 'user'])
            // musisi harus approved
            ->where('status', 'approved')
            // user yang punya musisi harus aktif
            ->whereHas('user', function ($q) {
                $q->where('is_active', true);
            })
            ->when($qMusisi, function ($query) use ($qMusisi) {
                $query->where(function ($qq) use ($qMusisi) {
                    $qq->where('genre', 'like', "%{$qMusisi}%")
                        ->orWhere('domisili', 'like', "%{$qMusisi}%")
                        ->orWhereHas('profil', function ($qp) use ($qMusisi) {
                            $qp->where('nama_panggung', 'like', "%{$qMusisi}%");
                        });
                });
            })
            ->when($genreMusisi, fn($q) => $q->where('genre', $genreMusisi))
            ->when($domisiliMusisi, fn($q) => $q->where('domisili', $domisiliMusisi))
            ->orderByDesc('approved_at'); // lebih logis urut dari yang baru disetujui

        // kalau kamu masih pakai kolom is_published di musisis
        if (Schema::hasColumn((new Musisi)->getTable(), 'is_published')) {
            $musisiQuery->where('is_published', 1);
        }

        $musisi = $musisiQuery->paginate(12)->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | PLAYLIST LAGU SIDEBAR
        |   - hanya lagu dari musisi approved + user aktif
        |--------------------------------------------------------------------------
        */
        $songQuery = Karya::with(['musisi.profil', 'musisi.user'])
            ->whereHas('musisi', function ($q) {
                $q->where('status', 'approved')
                  ->whereHas('user', function ($u) {
                      $u->where('is_active', true);
                  });
            })
            ->orderByDesc('updated_at');

        // optional: hanya lagu berstatus published kalau kolom status ada
        if (Schema::hasColumn((new Karya)->getTable(), 'status')) {
            $songQuery->where('status', 'published');
        }

        // Search lagu (judul + nama panggung musisi + genre/domilisi musisi)
        $songQuery->when($qSong, function ($qq) use ($qSong) {
            $qq->where('judul', 'like', "%{$qSong}%")
               ->orWhereHas('musisi', function ($qm) use ($qSong) {
                   $qm->where('genre', 'like', "%{$qSong}%")
                      ->orWhere('domisili', 'like', "%{$qSong}%")
                      ->orWhereHas('profil', function ($qp) use ($qSong) {
                          $qp->where('nama_panggung', 'like', "%{$qSong}%");
                      });
               });
        });

        // Filter genre lagu lewat genre musisi
        $songQuery->when($genreSong, function ($qq) use ($genreSong) {
            $qq->whereHas('musisi', function ($qm) use ($genreSong) {
                $qm->where('genre', $genreSong);
            });
        });

        $songs = $songQuery->limit(15)->get();

        /*
        |--------------------------------------------------------------------------
        | FAVORIT ID
        |--------------------------------------------------------------------------
        */
        $favoriteIds = [];
        if (Auth::check()) {
            $favoriteIds = LaguFavorit::where('user_id', Auth::id())
                ->pluck('karya_id')
                ->toArray();
        }

        return view('index', [
            'musisi'       => $musisi,
            'songs'        => $songs,

            // untuk blue search bar (grid musisi)
            'q'            => $qMusisi,
            'genre'        => $genreMusisi,
            'domisili'     => $domisiliMusisi,

            // untuk playlist
            'qSong'        => $qSong,
            'genreSong'    => $genreSong,

            'favoriteIds'  => $favoriteIds,
        ]);
    }
}
