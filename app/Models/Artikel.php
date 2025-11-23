<?php
// app/Models/Artikel.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
use App\Models\Komentar;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikels';
    protected $primaryKey = 'id_artikel';

    protected $fillable = [
        'author', 'judul', 'slug', 'konten', 'metatag', 'cover_path', 'published_at',
    ];

    // Cast datetime
    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Scope: artikel yang sudah terbit.
     * Dibandingkan dengan waktu saat ini dalam UTC.
     */
    public function scopePublished($q)
    {
        return $q->whereNotNull('published_at')
                 ->where('published_at', '<=', now('UTC'));
    }

    /**
     * Akses published_at dalam WIB untuk dipakai di view.
     */
    public function getPublishedAtWibAttribute(): ?Carbon
    {
        return $this->published_at?->copy()->timezone('Asia/Jakarta');
    }

    /**
     * Relasi: 1 Artikel punya banyak Komentar
     * Urut kronologis: paling lama di atas, paling baru di bawah.
     */
    public function komentars()
    {
        return $this->hasMany(Komentar::class, 'artikel_id', 'id_artikel')
                    ->oldest(); // komentar terbaru berada di bagian paling bawah
    }
}
