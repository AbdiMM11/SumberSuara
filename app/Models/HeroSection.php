<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $table = 'hero_sections';
    protected $primaryKey = 'id_heroSec';
    protected $fillable = ['banner','desk','sec1','sec2','sec3','is_active'];
    protected $casts = ['is_active' => 'boolean'];

    // Accessors: path relatif di DB → URL publik
    public function getBannerUrlAttribute(): ?string  { return $this->banner ? asset($this->banner) : null; }
    public function getSec1UrlAttribute(): ?string     { return $this->sec1 ? asset($this->sec1) : null; }
    public function getSec2UrlAttribute(): ?string     { return $this->sec2 ? asset($this->sec2) : null; }
    public function getSec3UrlAttribute(): ?string     { return $this->sec3 ? asset($this->sec3) : null; }
}
