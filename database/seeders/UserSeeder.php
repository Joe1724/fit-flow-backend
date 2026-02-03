<?php

namespace Database\Seeders;

// FINAL FIX - Manual Paste
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Admin
        $adminEmail = 'admin@example.com';
        User::create([
            'name' => 'Admin User',
            'email' => $adminEmail,
            'email_hash' => hash('sha256', $adminEmail),
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // 2. Create Trainer
        $coachEmail = 'coach@example.com';
        User::create([
            'name' => 'Coach Sarah',
            'email' => $coachEmail,
            'email_hash' => hash('sha256', $coachEmail),
            'password' => Hash::make('password123'),
            'role' => 'trainer',
        ]);

        // 3. Create Member
        $memberEmail = 'member@example.com';
        User::create([
            'name' => 'John Member',
            'email' => $memberEmail,
            'email_hash' => hash('sha256', $memberEmail),
            'password' => Hash::make('password123'),
            'role' => 'member',
        ]);
    }
}