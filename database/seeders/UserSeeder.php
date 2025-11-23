<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'nama' => 'Admin Utama',
            'email' => 'admin@sumbersuara.com',
            'password' => Hash::make('password123'), // Ganti dengan password yang aman
            'roles_id' => 1, // Role Admin
            'foto_user' => null,
            'permissions' => json_encode(['manage_all']),
        ]);

        // Musisi
        User::create([
            'nama' => 'Musisi Sumber Suara',
            'email' => 'musisi@sumbersuara.com',
            'password' => Hash::make('password123'),
            'roles_id' => 2, // Role Musisi
            'foto_user' => null,
            'permissions' => json_encode(['upload_music', 'edit_profile']),
        ]);

        // Audiens
        User::create([
            'nama' => 'Audiens Musik',
            'email' => 'audiens@sumbersuara.com',
            'password' => Hash::make('password123'),
            'roles_id' => 3, // Role Audiens
            'foto_user' => null,
            'permissions' => json_encode(['like_music', 'comment']),
        ]);
    }
}
