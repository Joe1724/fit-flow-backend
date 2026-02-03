<?php

namespace Database\Seeders;

// We are putting the logic DIRECTLY here to bypass the broken UserSeeder file.
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'email_hash' => hash('sha256', 'admin@example.com'),
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // 2. Create Trainer
        User::firstOrCreate(
            ['email' => 'coach@example.com'],
            [
                'name' => 'Coach Sarah',
                'email_hash' => hash('sha256', 'coach@example.com'),
                'password' => Hash::make('password123'),
                'role' => 'trainer',
            ]
        );

        // 3. Create Member
        User::firstOrCreate(
            ['email' => 'member@example.com'],
            [
                'name' => 'John Member',
                'email_hash' => hash('sha256', 'member@example.com'),
                'password' => Hash::make('password123'),
                'role' => 'member',
            ]
        );
    }
}