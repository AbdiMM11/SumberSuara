<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LaguFavorit extends Model
{
    use HasFactory;

    protected $table = 'lagu_favorit';

    protected $fillable = [
        'user_id',
        'karya_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function karya()
    {
        return $this->belongsTo(Karya::class, 'karya_id', 'id_karya');
    }
}
