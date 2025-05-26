<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Fasilitas extends Model
{
    use HasFactory;

    protected $fillable = ['nama_fasilitas']; 

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class, 'fasilitas_property', 'fasilitas_id', 'property_id');
    }
}
