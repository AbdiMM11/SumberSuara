<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// tambahkan use untuk relasi
use App\Models\Musisi;
use App\Models\Audiens;
use App\Models\Karya;
use App\Models\LaguFavorit;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'email',
        'foto_user',
        'password',
        'roles_id',
        'permissions',
        'is_active', // kolom baru untuk status aktif/tidak
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'permissions' => 'array',
        'is_active'   => 'boolean', // supaya otomatis jadi true/false
    ];

    /* ============================
     *   RELASI
     * ============================ */

    public function role()
    {
        return $this->belongsTo(Role::class, 'roles_id');
    }

    public function musisi()
    {
        // lokal key id -> foreign key user_id
        return $this->hasOne(Musisi::class, 'user_id', 'id');
    }

    public function audiens()
    {
        return $this->hasOne(Audiens::class, 'user_id', 'id');
    }

    /* ============================
     *   Relasi Lagu Favorit
     * ============================ */

    // daftar record di tabel lagu_favorit milik user ini
    public function laguFavorit()
    {
        return $this->hasMany(LaguFavorit::class, 'user_id', 'id');
    }

    // langsung akses daftar Karya yang difavoritkan user ini
    public function favoriteKaryas()
    {
        return $this->belongsToMany(Karya::class, 'lagu_favorit', 'user_id', 'karya_id')
                    ->withTimestamps();
    }

    /* ============================
     *   Helper Role
     * ============================ */

    /**
     * Cek apakah user ini Admin.
     */
    public function isAdmin(): bool
    {
        return $this->role?->nama_roles === 'Admin';
    }

    /**
     * Cek apakah user ini Musisi.
     */
    public function isMusisi(): bool
    {
        return $this->role?->nama_roles === 'Musisi';
    }

    /**
     * Cek apakah user ini Audiens.
     */
    public function isAudiens(): bool
    {
        return $this->role?->nama_roles === 'Audiens';
    }

    /**
     * Cek apakah akun user ini aktif.
     */
    public function isActive(): bool
    {
        return (bool) $this->is_active;
    }
}
