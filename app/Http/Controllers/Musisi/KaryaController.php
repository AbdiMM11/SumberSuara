<?php

namespace App\Http\Controllers\Musisi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Karya;
use App\Models\Musisi;

class KaryaController extends Controller
{
    // Helper: pastikan data musisi ADA (kalau belum, dibuat)
    protected function getCurrentMusisi(): Musisi
    {
        $user = Auth::user();

        // kalau relasi sudah ada, pakai itu
        if ($user->musisi) {
            return $user->musisi;
        }

        // kalau belum ada (habis migrate:fresh), buat baru
        return Musisi::firstOrCreate(['user_id' => $user->id]);
    }

    public function index(Request $request)
    {
        $musisi = $this->getCurrentMusisi();

        $q = trim((string) $request->input('q'));

        $karyas = Karya::query()
            ->forMusisi($musisi->id_musisi)
            ->when($q, fn ($qq) => $qq->search($q))
            ->with(['musisi.profil']) // supaya coverUrl (logo) tidak N+1
            ->orderByDesc('updated_at')
            ->paginate(12)
            ->withQueryString();

        return view('musisi.karya', compact('karyas', 'q'));
    }

    public function create()
    {
        // pastikan musisi ada dulu
        $this->getCurrentMusisi();

        return view('musisi.createKarya');
    }

    public function store(Request $request)
    {
        $musisi = $this->getCurrentMusisi();

        $data = $request->validate([
            'judul'    => ['required', 'string', 'max:150'],
            'tahun'    => ['nullable', 'integer', 'digits:4', 'min:1900', 'max:' . date('Y')],
            'file_mp3' => ['required', 'file', 'mimetypes:audio/mpeg,audio/mp3', 'max:15360'],
        ]);

        $karya = new Karya();
        $karya->id_musisi = $musisi->id_musisi;
        $karya->judul     = $data['judul'];
        $karya->tahun     = $data['tahun'] ?? null;
        $karya->slug      = Str::slug($data['judul'] . '-' . uniqid());

        if ($request->hasFile('file_mp3')) {
            $karya->file_mp3 = $request->file('file_mp3')->store('karya/audio', 'public');
        }

        // ❌ Tidak ada lagi status/published_at
        $karya->save();

        return redirect()->route('musisi.karya')->with('success', 'Karya berhasil ditambahkan.');
    }

    public function edit(int $karya)
    {
        $musisi = $this->getCurrentMusisi();

        $karya = Karya::forMusisi($musisi->id_musisi)
            ->with(['musisi.profil'])
            ->findOrFail($karya);

        return view('musisi.editKarya', compact('karya'));
    }

    public function update(Request $request, int $karya)
    {
        $musisi = $this->getCurrentMusisi();

        $karya = Karya::forMusisi($musisi->id_musisi)->findOrFail($karya);

        $data = $request->validate([
            'judul'    => ['required', 'string', 'max:150'],
            'tahun'    => ['nullable', 'integer', 'digits:4', 'min:1900', 'max:' . date('Y')],
            'file_mp3' => ['nullable', 'file', 'mimetypes:audio/mpeg,audio/mp3', 'max:15360'],
        ]);

        $karya->judul = $data['judul'];
        $karya->tahun = $data['tahun'] ?? null;

        if (!$karya->slug) {
            $karya->slug = Str::slug($data['judul'] . '-' . uniqid());
        }

        if ($request->hasFile('file_mp3')) {
            if ($karya->file_mp3 && Storage::disk('public')->exists($karya->file_mp3)) {
                Storage::disk('public')->delete($karya->file_mp3);
            }
            $karya->file_mp3 = $request->file('file_mp3')->store('karya/audio', 'public');
        }

        // ❌ Tidak ada lagi status/published_at
        $karya->save();

        return redirect()->route('musisi.karya')->with('success', 'Karya berhasil diperbarui.');
    }

    public function destroy(int $karya)
    {
        $musisi = $this->getCurrentMusisi();

        $karya = Karya::forMusisi($musisi->id_musisi)->findOrFail($karya);

        if ($karya->file_mp3 && Storage::disk('public')->exists($karya->file_mp3)) {
            Storage::disk('public')->delete($karya->file_mp3);
        }

        $karya->delete();

        return redirect()->route('musisi.karya')->with('success', 'Karya berhasil dihapus.');
    }
}
