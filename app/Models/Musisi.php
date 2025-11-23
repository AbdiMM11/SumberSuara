<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Musisi extends Model
{
    use HasFactory;

    protected $table = 'musisis';
    protected $primaryKey = 'id_musisi';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'no_telp',
        'domisili',
        'genre',
        'spotify',
        'instagram',
        'youtube',
        'file_mp3',
        'status',       // pending / approved / rejected
        'approved_at',  // waktu disetujui admin
    ];

    protected $casts = [
        'user_id'     => 'integer',
        'no_telp'     => 'string',
        'domisili'    => 'string',
        'genre'       => 'string',
        'spotify'     => 'string',
        'instagram'   => 'string',
        'youtube'     => 'string',
        'file_mp3'    => 'string',
        'status'      => 'string',
        'approved_at' => 'datetime',
    ];

    // otomatis ikut dikirim saat toArray() / toJson()
    protected $appends = ['display_name'];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        // relasi ke tabel users (FK: user_id)
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function profil()
    {
        return $this->hasOne(Profil::class, 'id_musisi', 'id_musisi');
    }

    public function karyas()
    {
        return $this->hasMany(Karya::class, 'id_musisi', 'id_musisi');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR
    |--------------------------------------------------------------------------
    */

    public function getDisplayNameAttribute(): string
    {
        if ($this->profil && $this->profil->nama_panggung) {
            return $this->profil->nama_panggung;
        }

        // kolom di tabel users adalah 'nama', bukan 'name'
        if ($this->user && $this->user->nama) {
            return $this->user->nama;
        }

        return 'Musisi #' . $this->id_musisi;
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER STATUS
    |--------------------------------------------------------------------------
    */

    /**
     * Musisi dianggap pending jika:
     * - status = 'pending', atau
     * - status masih null (belum diset sama sekali)
     */
    public function isPending(): bool
    {
        return $this->status === null || $this->status === 'pending';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS SOSIAL MEDIA
    |--------------------------------------------------------------------------
    */

    public function setSpotifyAttribute($value)
    {
        $this->attributes['spotify'] = $this->cleanSocialUsername($value);
    }

    public function setInstagramAttribute($value)
    {
        $this->attributes['instagram'] = $this->cleanSocialUsername($value);
    }

    public function setYoutubeAttribute($value)
    {
        $this->attributes['youtube'] = $this->cleanSocialUsername($value);
    }

    /**
     * Bersihkan input username/ID sosmed:
     * - trim spasi
     * - jika user paste link (http / www), ambil segmen terakhir setelah '/'
     * - hapus '@' di awal jika ada
     * - jika kosong → null
     */
    protected function cleanSocialUsername($value): ?string
    {
        if ($value === null) {
            return null;
        }

        $value = trim($value);

        if ($value === '') {
            return null;
        }

        // kalau mengandung http / www, berarti kemungkinan besar link
        if (str_contains($value, 'http') || str_contains($value, 'www.')) {
            $parts = explode('/', rtrim($value, '/'));
            $last  = end($parts);

            if (!empty($last)) {
                $value = $last;
            }
        }

        // hapus '@' di awal
        $value = ltrim($value, '@');

        return $value;
    }
}
