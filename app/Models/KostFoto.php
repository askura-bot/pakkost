<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KostFoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'path',
        'is_virtual_tour',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
