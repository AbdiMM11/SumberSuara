<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSectionController extends Controller
{
    public function index()
    {
        $hero = HeroSection::first();

        return view('admin.heroSection', compact('hero'));
    }

    public function store(Request $request)
    {
        $hero = HeroSection::first();

        // Validasi
        $rules = [
            'gambar'    => [$hero ? 'sometimes' : 'required', 'file', 'image', 'max:3072'],
            'deskripsi' => ['sometimes', 'nullable', 'string', 'max:1000'],
            'hero1'     => ['sometimes', 'file', 'image', 'max:3072'],
            'hero2'     => ['sometimes', 'file', 'image', 'max:3072'],
            'hero3'     => ['sometimes', 'file', 'image', 'max:3072'],
        ];

        $request->validate($rules);

        if (!$hero) {
            $hero = new HeroSection();
        }

        // Helper: hapus file lama di disk public
        $removeIfExists = function (?string $path) {
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        };

        // Helper: simpan file ke disk "public" → storage/app/public/hero/xxx.ext
        $saveToPublicHero = function (string $inputName) use ($request): ?string {
            if (!$request->hasFile($inputName)) {
                return null;
            }

            // hasil: "hero/namafile.ext"
            return $request->file($inputName)->store('hero', 'public');
        };

        // Banner utama
        if ($request->hasFile('gambar')) {
            $removeIfExists($hero->banner);
            $hero->banner = $saveToPublicHero('gambar');  // contoh: hero/banner-uuid.jpg
        }

        // Deskripsi / tagline
        if ($request->filled('deskripsi')) {
            $hero->desk = $request->input('deskripsi');
        }

        // Hero sekunder 1
        if ($request->hasFile('hero1')) {
            $removeIfExists($hero->sec1);
            $hero->sec1 = $saveToPublicHero('hero1');
        }

        // Hero sekunder 2
        if ($request->hasFile('hero2')) {
            $removeIfExists($hero->sec2);
            $hero->sec2 = $saveToPublicHero('hero2');
        }

        // Hero sekunder 3
        if ($request->hasFile('hero3')) {
            $removeIfExists($hero->sec3);
            $hero->sec3 = $saveToPublicHero('hero3');
        }

        $hero->is_active = true;
        $hero->save();

        return back()->with('success', 'Hero Section berhasil disimpan.');
    }
}
