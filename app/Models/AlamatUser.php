<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class AlamatUser extends Model
{
    use HasFactory;

    protected $table = 'alamat_user';

    protected $fillable = [
        'user_id',
        'kelurahan',
        'jalan',
        'rw',
        'rt',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
