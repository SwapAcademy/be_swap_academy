<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        User::create([
            'name' => 'Default User',
            'username' => 'defaultuser',
            'email' => 'default@example.com',
            'password' => Hash::make('password'), // Pastikan password di-hash
            'role' => 'user', // Sesuaikan dengan nilai yang ada di RoleEnum
            'progress' => 100,
            'credits' => 50,
            'dashboard_preferences' => 75,
            'remember_token' => \Illuminate\Support\Str::random(10),
        ]);

        User::factory()
            ->count(10)
            ->create();
    }
}
