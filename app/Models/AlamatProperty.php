<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlamatProperty extends Model
{
    use HasFactory;

    protected $table = 'alamat_properties';

    protected $fillable = [
        'property_id',
        'kelurahan',
        'jalan',
        'rt',
        'rw',
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
