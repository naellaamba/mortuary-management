<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Compte Administrateur
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrateur',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Compte Staff / Agent
        User::updateOrCreate(
            ['email' => 'staff@example.com'],
            [
                'name' => 'Agent Staff',
                'password' => Hash::make('password'),
                'role' => 'staff',
                'email_verified_at' => now(),
            ]
        );

        // Compte Utilisateur standard
        User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Utilisateur Test',
                'password' => Hash::make('password'),
                'role' => 'staff',
                'email_verified_at' => now(),
            ]
        );
    }
}
