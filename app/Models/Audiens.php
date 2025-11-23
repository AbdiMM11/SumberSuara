<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audiens extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_audiens';

    protected $fillable = [
        'user_id',
        'umur',
        'jenis_kelamin',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'umur'    => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
