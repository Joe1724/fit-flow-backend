<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Admin (Safe Mode)
        $adminEmail = 'admin@example.com';
        User::firstOrCreate(
            ['email' => $adminEmail], // Check if this email exists...
            [
                'name' => 'Admin User',
                'email_hash' => hash('sha256', $adminEmail),
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // 2. Create Trainer
        $coachEmail = 'coach@example.com';
        User::firstOrCreate(
            ['email' => $coachEmail],
            [
                'name' => 'Coach Sarah',
                'email_hash' => hash('sha256', $coachEmail),
                'password' => Hash::make('password123'),
                'role' => 'trainer',
            ]
        );

        // 3. Create Member
        $memberEmail = 'member@example.com';
        User::firstOrCreate(
            ['email' => $memberEmail],
            [
                'name' => 'John Member',
                'email_hash' => hash('sha256', $memberEmail),
                'password' => Hash::make('password123'),
                'role' => 'member',
            ]
        );
    }
}