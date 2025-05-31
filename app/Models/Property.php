<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Property extends Model
{
    use HasFactory;

    protected $table = 'propertys'; // jika memang nama tabelnya tidak baku (jamak tidak beraturan)

    protected $fillable = [
        'user_id',
        'nama_properti',
        'alamat',
        'harga',
        'tipe',
        'sewa_jenis',
        'jumlah_kamar',
    ];

    public function pemilik(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function fotos(): HasMany
    {
        return $this->hasMany(KostFoto::class);
    }

    public function ulasans(): HasMany
    {
        return $this->hasMany(Ulasan::class, 'property_id');
    }

    public function alamatProperty(): HasOne
    {
        return $this->hasOne(AlamatProperty::class, 'property_id');
    }

    public function fasilitas(): BelongsToMany
    {
        return $this->belongsToMany(Fasilitas::class, 'fasilitas_property', 'property_id', 'fasilitas_id');
    }

    public function getRemainingImageSlotsAttribute()
    {
        return max(0, 5 - $this->fotos()->count());
    }
}

