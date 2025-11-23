<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profil extends Model
{
    use HasFactory;

    protected $table = 'profils';
    protected $primaryKey = 'id_profil';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_musisi',
        'nama_panggung',
        'foto',
        'logo',
        'foto_pilihan1',
        'foto_pilihan2',
        'foto_pilihan3',
        'desk_musisi',
    ];

    protected $casts = [
        'id_musisi'     => 'integer',
        'nama_panggung' => 'string',
        'foto'          => 'string',
        'logo'          => 'string',
        'foto_pilihan1' => 'string',
        'foto_pilihan2' => 'string',
        'foto_pilihan3' => 'string',
        'desk_musisi'   => 'string',
    ];

    protected $appends = ['foto_url','logo_url','galeri_urls'];

    public function musisi()
    {
        return $this->belongsTo(Musisi::class, 'id_musisi', 'id_musisi');
    }

    public function getFotoUrlAttribute(): ?string
    {
        return $this->foto ? asset('storage/'.$this->foto) : null;
    }

    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo ? asset('storage/'.$this->logo) : null;
    }

    public function getGaleriUrlsAttribute(): array
    {
        $urls = [];
        foreach (['foto_pilihan1', 'foto_pilihan2', 'foto_pilihan3'] as $col) {
            if ($this->{$col}) {
                $urls[] = asset('storage/'.$this->{$col});
            }
        }
        return $urls;
    }
}
