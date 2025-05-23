<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KostFoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'file_path',
        'link_VT',
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}

