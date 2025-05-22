<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ulasan extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'username',
        'rating',
        'komentar',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
