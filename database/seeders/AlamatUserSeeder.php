<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\AlamatUser;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AlamatUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Custom alamat data berdasarkan user_id
        $alamatList = [
            [
                'user_id'   => User::where('email', 'admin@gmail.com')->first()?->id,
                'kelurahan' => 'Kelurahan A',
                'jalan'     => 'Jl. Merdeka No.1',
                'rw'        => '01',
                'rt'        => '02',
            ],
        ];

        foreach ($alamatList as $alamat) {
            if ($alamat['user_id']) {
                AlamatUser::create($alamat);
            }
        }
    }
}
