<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ArtikelController extends Controller
{
    /* =======================
     *         PUBLIK
     * =======================*/

    // GET /article
    public function indexPublic()
    {
        $artikels = Artikel::published()               // scope published (bandingkan dengan now('UTC'))
                        ->orderByDesc('published_at')
                        ->paginate(9);

        $rekomendasi = Artikel::published()
                        ->latest('published_at')
                        ->limit(5)
                        ->get();

        // view index artikel publik
        return view('article', compact('artikels', 'rekomendasi'));
    }

    // GET /view/artikel/{slug}
    public function showPublic(string $slug)
    {
        // Eager load komentars + user untuk hindari N+1 query
        $artikel = Artikel::with(['komentars.user'])
            ->where('slug', $slug)
            ->firstOrFail();

        // karena file kamu disimpan di resources/views/viewArtikel.blade.php
        return view('viewArtikel', compact('artikel'));
    }


    /* =======================
     *          ADMIN
     * =======================*/

    // GET /admin/artikel
    public function adminIndex(Request $request)
    {
        $q = $request->input('q');

        $artikels = Artikel::when($q, function ($query) use ($q) {
                            $query->where(function ($qq) use ($q) {
                                $qq->where('judul', 'like', "%{$q}%")
                                   ->orWhere('author', 'like', "%{$q}%");
                            });
                        })
                        ->orderByDesc('published_at')
                        ->orderByDesc('created_at')
                        ->paginate(10)
                        ->withQueryString();

        return view('admin.artikel', compact('artikels', 'q'));
    }

    // GET /admin/create/artikel
    public function adminCreate()
    {
        return view('admin.createArtikel');
    }

    // POST /admin/artikel
    public function adminStore(Request $request)
    {
        $data = $request->validate([
            'judul'        => 'required|string|max:180',
            'author'       => 'required|string|max:120',
            'metatag'      => 'nullable|string|max:255',
            'konten'       => 'required|string',
            'gambar'       => 'nullable|image|max:10240', // 10 MB
            'published_at' => 'nullable|date',
        ]);

        $cover = $request->hasFile('gambar')
            ? $request->file('gambar')->store('articles', 'public')
            : null;

        // Anggap input datetime-local adalah WIB → simpan sebagai UTC
        $publishedAt = $request->filled('published_at')
            ? Carbon::createFromFormat('Y-m-d\TH:i', $request->published_at, 'Asia/Jakarta')->utc()
            : now('UTC');

        Artikel::create([
            'judul'        => $data['judul'],
            'author'       => $data['author'],
            'metatag'      => $data['metatag'] ?? null,
            'konten'       => $data['konten'],
            'cover_path'   => $cover,
            'published_at' => $publishedAt,
            'slug'         => Str::slug($data['judul']).'-'.Str::random(6),
        ]);

        return redirect()->route('admin.artikel')->with('ok', 'Artikel berhasil dibuat.');
    }

    // GET /admin/artikel/{artikel}/edit
    public function adminEdit(Artikel $artikel)
    {
        return view('admin.editArtikel', compact('artikel'));
    }

    // PUT /admin/artikel/{artikel}
    public function adminUpdate(Request $request, Artikel $artikel)
    {
        $data = $request->validate([
            'judul'        => 'required|string|max:180',
            'author'       => 'required|string|max:120',
            'metatag'      => 'nullable|string|max:255',
            'konten'       => 'required|string',
            'gambar'       => 'nullable|image|max:10240', // 10 MB
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('gambar')) {
            if ($artikel->cover_path) {
                Storage::disk('public')->delete($artikel->cover_path);
            }
            $artikel->cover_path = $request->file('gambar')->store('articles', 'public');
        }

        if ($artikel->judul !== $data['judul']) {
            $artikel->slug = Str::slug($data['judul']).'-'.Str::random(6);
        }

        $artikel->fill([
            'judul'        => $data['judul'],
            'author'       => $data['author'],
            'metatag'      => $data['metatag'] ?? null,
            'konten'       => $data['konten'],
            'published_at' => $request->filled('published_at')
                ? Carbon::createFromFormat('Y-m-d\TH:i', $request->published_at, 'Asia/Jakarta')->utc()
                : $artikel->published_at,
        ])->save();

        return redirect()->route('admin.artikel')->with('ok', 'Artikel diperbarui.');
    }

    // DELETE /admin/artikel/{artikel}
    public function adminDestroy(Artikel $artikel)
    {
        if ($artikel->cover_path) {
            Storage::disk('public')->delete($artikel->cover_path);
        }
        $artikel->delete();

        return back()->with('ok', 'Artikel dihapus.');
    }
}
