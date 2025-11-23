<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $table = 'hero_sections';
    protected $primaryKey = 'id_heroSec';

    protected $fillable = [
        'banner',
        'desk',
        'sec1',
        'sec2',
        'sec3',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Helper untuk membentuk URL publik.
     * Di DB kita simpan "hero/xxxx.jpg" (relatif ke storage/app/public).
     * Di browser diakses via "storage/app/public/hero/xxxx.jpg".
     */
    protected function buildUrl(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        // Sesuaikan dengan pola yang sudah dipakai logo/foto musisi
        return asset('storage/app/public/' . ltrim($path, '/'));
    }

    public function getBannerUrlAttribute(): ?string
    {
        return $this->buildUrl($this->banner);
    }

    public function getSec1UrlAttribute(): ?string
    {
        return $this->buildUrl($this->sec1);
    }

    public function getSec2UrlAttribute(): ?string
    {
        return $this->buildUrl($this->sec2);
    }

    public function getSec3UrlAttribute(): ?string
    {
        return $this->buildUrl($this->sec3);
    }
}
