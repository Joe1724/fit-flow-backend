<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Coach Sarah',
            'email' => 'coach@example.com',
            'password' => Hash::make('password123'),
            'role' => 'trainer',
        ]);

        User::create([
            'name' => 'John Member',
            'email' => 'member@example.com',
            'password' => Hash::make('password123'),
            'role' => 'member',
        ]);

    }
}
