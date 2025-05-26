<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Custom user data
        $users = [
            [
                'name' => 'Admin Utama',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('qwerty123'),
                'no_wa' => '082137787134',
                'role' => 'admin',
            ],
            [
                'name' => 'Owner Kost 1',
                'email' => 'owner1@gmail.com',
                'password' => Hash::make('qwerty123'),
                'no_wa' => '082137787134',
                'role' => 'pemilik',
            ],
            // Tambahkan data user lain sesuai kebutuhan
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
