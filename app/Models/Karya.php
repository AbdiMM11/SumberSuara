<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// tambahkan use untuk relasi favorit & user
use App\Models\Musisi;
use App\Models\User;
use App\Models\LaguFavorit;

class Karya extends Model
{
    use HasFactory;

    protected $table = 'karyas';
    protected $primaryKey = 'id_karya';
    public $incrementing = true;
    protected $keyType = 'int';

    // kolom yang memang ada di tabel dan dipakai di aplikasi
    protected $fillable = [
        'id_musisi',
        'judul',
        'tahun',
        'slug',
        'file_mp3',
        'cover_path',
        'durasi_detik',
        // 'status',
        // 'published_at'
    ];

    protected $casts = [
        'tahun'        => 'integer',
        'durasi_detik' => 'integer',
        // 'published_at' => 'datetime',
    ];

    /* ========== Relasi ========== */

    public function musisi()
    {
        return $this->belongsTo(Musisi::class, 'id_musisi', 'id_musisi')
            ->withDefault();
    }

    // semua record lagu_favorit yang menunjuk ke karya ini
    public function laguFavorit()
    {
        return $this->hasMany(LaguFavorit::class, 'karya_id', 'id_karya');
    }

    // semua user yang memfavoritkan karya ini
    public function favoredByUsers()
    {
        return $this->belongsToMany(User::class, 'lagu_favorit', 'karya_id', 'user_id')
                    ->withTimestamps();
    }

    /* ========== Accessors ========== */

    public function getAudioUrlAttribute(): string
    {
        return $this->file_mp3
            ? asset('storage/' . ltrim($this->file_mp3, '/'))
            : '';
    }

    // coverUrl mengambil dari logo profil musisi / placeholder
    public function getCoverUrlAttribute(): string
    {
        $logo = $this->musisi?->profil?->logo;

        return $logo
            ? asset('storage/' . ltrim($logo, '/'))
            : asset('images/placeholder-logo.png');
    }

    public function getDurasiFormatAttribute(): ?string
    {
        if (!$this->durasi_detik) {
            return null;
        }

        $menit = intdiv($this->durasi_detik, 60);
        $detik = $this->durasi_detik % 60;

        return sprintf('%02d:%02d', $menit, $detik);
    }

    /* ========== Scopes ========== */

    public function scopeForMusisi($q, int $idMusisi)
    {
        return $q->where('id_musisi', $idMusisi);
    }

    public function scopeSearch($q, ?string $term)
    {
        if (!$term) return $q;

        return $q->where(function ($qq) use ($term) {
            $qq->where('judul', 'like', "%{$term}%")
               ->orWhere('tahun', 'like', "%{$term}%");
        });
    }
}
