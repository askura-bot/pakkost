<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_properti',
        'alamat',
        'harga',
        'fasilitas',
        'tipe',
        'sewa_jenis',
        'jumlah_kamar',
    ];

    public function pemilik()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function fotos()
    {
        return $this->hasMany(KostFoto::class);
    }

    public function ulasans()
    {
        return $this->hasMany(Ulasan::class);
    }
}
