<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
            'gambar'    => [$hero ? 'sometimes' : 'required', 'file','image','max:3072'],
            'deskripsi' => ['sometimes','nullable','string','max:1000'],
            'hero1'     => ['sometimes','file','image','max:3072'],
            'hero2'     => ['sometimes','file','image','max:3072'],
            'hero3'     => ['sometimes','file','image','max:3072'],
        ];
        $request->validate($rules);

        if (!$hero) $hero = new HeroSection();

        // Pastikan folder public/hero ada
        if (!is_dir(public_path('hero'))) {
            @mkdir(public_path('hero'), 0755, true);
        }

        // Helper hapus file lama
        $removeIfExists = function (?string $relPath) {
            if ($relPath) {
                $full = public_path($relPath);
                if (is_file($full)) @unlink($full);
            }
        };

        // Helper simpan file ke public/hero → return "hero/filename.ext"
        $saveToPublicHero = function (string $inputName): ?string {
            $file = request()->file($inputName);
            if (!$file) return null;
            $ext  = $file->getClientOriginalExtension();
            $name = Str::uuid()->toString().'.'.$ext; // nama unik
            $file->move(public_path('hero'), $name);
            return 'hero/'.$name;
        };

        // Banner (utama)
        if ($request->hasFile('gambar')) {
            $removeIfExists($hero->banner);
            $hero->banner = $saveToPublicHero('gambar');
        }

        // Deskripsi (opsional)
        if ($request->filled('deskripsi')) {
            $hero->desk = $request->input('deskripsi');
        }

        // Sekunder 1..3
        if ($request->hasFile('hero1')) {
            $removeIfExists($hero->sec1);
            $hero->sec1 = $saveToPublicHero('hero1');
        }
        if ($request->hasFile('hero2')) {
            $removeIfExists($hero->sec2);
            $hero->sec2 = $saveToPublicHero('hero2');
        }
        if ($request->hasFile('hero3')) {
            $removeIfExists($hero->sec3);
            $hero->sec3 = $saveToPublicHero('hero3');
        }

        $hero->is_active = true;
        $hero->save();

        return back()->with('success', 'Hero Section berhasil disimpan.');
    }
}
