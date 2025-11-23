<?php

namespace App\Http\Controllers\Musisi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Musisi;
use App\Models\Profil;

class MusisiProfilController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        // Pastikan record musisi ada
        $musisi = $user->musisi ?? Musisi::firstOrCreate(['user_id' => $user->id]);

        // Profil bisa null (dibuat saat update pertama)
        $profil = $musisi->profil;

        return view('musisi.profil', compact('musisi', 'profil'));
    }

    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        // Pastikan record musisi ada
        $musisi = $user->musisi ?? Musisi::firstOrCreate(['user_id' => $user->id]);

        // Ambil/buat profil
        $profil = $musisi->profil ?: new Profil(['id_musisi' => $musisi->id_musisi]);

        // =========================
        // VALIDASI PROFIL
        // =========================
        $validatedProfil = Validator::make($request->all(), [
            'nama'       => ['nullable','string','max:100'],   // -> nama_panggung
            'deskripsi'  => ['nullable','string','max:1000'],  // -> desk_musisi
            'logo'       => ['nullable','image','max:2048'],
            'foto_utama' => ['nullable','image','max:4096'],
            'foto1'      => ['nullable','image','max:4096'],
            'foto2'      => ['nullable','image','max:4096'],
            'foto3'      => ['nullable','image','max:4096'],
        ])->validate();

        // =========================
        // VALIDASI MUSISI (SOSMED = USERNAME/ID SAJA)
        // =========================
        $validatedMusisi = Validator::make($request->all(), [
            'genre'     => ['nullable','string','max:60'],
            'domisili'  => ['nullable','string','max:60'],

            // username / ID saja, tanpa link dan tanpa @
            'spotify'   => ['nullable','string','max:40','regex:/^[A-Za-z0-9._-]{3,40}$/'],
            'instagram' => ['nullable','string','max:30','regex:/^[A-Za-z0-9._]{3,30}$/'],
            'youtube'   => ['nullable','string','max:40','regex:/^[A-Za-z0-9._-]{3,40}$/'],
        ], [
            'spotify.regex'   => 'Masukkan username/ID Spotify (huruf/angka/._-), tanpa spasi dan tanpa tautan.',
            'instagram.regex' => 'Masukkan username Instagram (huruf/angka/._, 3–30 karakter, tanpa tautan).',
            'youtube.regex'   => 'Masukkan handle YouTube (huruf/angka/._-, 3–40 karakter, tanpa tautan).',
        ])->validate();

        // =========================
        // MAPPING PROFIL
        // =========================
        if (array_key_exists('nama', $validatedProfil)) {
            $profil->nama_panggung = $validatedProfil['nama'];
        }

        if (array_key_exists('deskripsi', $validatedProfil)) {
            $profil->desk_musisi = $validatedProfil['deskripsi'];
        }

        // =========================
        // ISI DATA MUSISI
        // (mutator di Model akan tetap membersihkan jika user paste link / pakai @)
        // =========================
        $musisi->fill([
            'genre'     => $validatedMusisi['genre']     ?? $musisi->genre,
            'domisili'  => $validatedMusisi['domisili']  ?? $musisi->domisili,
            'spotify'   => $validatedMusisi['spotify']   ?? $musisi->spotify,
            'instagram' => $validatedMusisi['instagram'] ?? $musisi->instagram,
            'youtube'   => $validatedMusisi['youtube']   ?? $musisi->youtube,
        ]);

        // =========================
        // UPLOAD FILE (hapus lama jika diganti)
        // =========================
        $profil->logo          = $this->handleUpload($request, 'logo',       'musisi/logo',       $profil->logo ?? null);
        $profil->foto          = $this->handleUpload($request, 'foto_utama', 'musisi/foto_utama', $profil->foto ?? null);
        $profil->foto_pilihan1 = $this->handleUpload($request, 'foto1',      'musisi/galeri',     $profil->foto_pilihan1 ?? null);
        $profil->foto_pilihan2 = $this->handleUpload($request, 'foto2',      'musisi/galeri',     $profil->foto_pilihan2 ?? null);
        $profil->foto_pilihan3 = $this->handleUpload($request, 'foto3',      'musisi/galeri',     $profil->foto_pilihan3 ?? null);

        // =========================
        // SIMPAN
        // =========================
        $musisi->save();
        $profil->musisi()->associate($musisi);
        $profil->save();

        return redirect()->route('musisi.profil')->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Upload helper — menghapus file lama jika diganti.
     */
    private function handleUpload(Request $request, string $inputName, string $dir, ?string $currentPath): ?string
    {
        if (!$request->hasFile($inputName)) {
            return $currentPath;
        }

        $disk = Storage::disk('public');

        if ($currentPath && $disk->exists($currentPath)) {
            $disk->delete($currentPath);
        }

        return $request->file($inputName)->store($dir, 'public');
    }
}
