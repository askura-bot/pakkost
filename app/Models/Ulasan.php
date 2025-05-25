<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ulasan extends Model
{
    use HasFactory;

    protected $table = 'ulasan';

    protected $fillable = [
        'property_id',
        'username',
        'komentar',
        'rating',
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
