<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Komentar extends Model
{
    use HasFactory;

    protected $table = 'komentars';
    protected $primaryKey = 'id_komentar';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'artikel_id',
        'user_id',
        'isi',
    ];

    /**
     * Relasi ke Artikel
     *
     * NOTE:
     * - Kalau PK di model Artikel = "id_artikel", biarkan seperti ini
     * - Kalau PK di model Artikel = "id", ganti 'id_artikel' jadi 'id'
     */
    public function artikel()
    {
        return $this->belongsTo(Artikel::class, 'artikel_id', 'id_artikel');
    }

    /**
     * Relasi ke User (yang memberi komentar)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
