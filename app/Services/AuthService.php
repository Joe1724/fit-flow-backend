<?php

namespace App\Services;

use App\Models\User;
use App\Models\MemberProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function registerUser(array $data)
    {
        return DB::transaction(function () use ($data){

            // 1. We must create the hash for the new user
            $emailHash = hash('sha256', $data['email']);

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'], // Model encrypts this automatically
                'email_hash' => $emailHash, // <--- IMPORTANT: Save the hash for login
                'password' => Hash::make($data['password']),
                'role' => 'member',
            ]);

            MemberProfile::create([
                'user_id' => $user->id,
                'phone' => $data['phone'] ?? null,
                'dob' => $data['dob'] ?? null,
                'emergency_contact' => $data['emergency_contact'] ?? null,
            ]);
            
            $token = $user->createToken('auth_token')->plainTextToken;

            return [
                'user' => $user,
                'token' => $token
            ];

        });
    }

    public function loginUser(string $email, string $password)
    {
        // 2. Hash the incoming email to search the database
        $emailHash = hash('sha256', $email);

        // 3. Find the user using the HASH, not the plain email
        $user = User::where('email_hash', $emailHash)->first();

        if(! $user || !Hash::check($password, $user->password)){
            throw ValidationException::withMessages([
                'email' => ['Invalid Credentials.'],
            ]);
        }

        return[
            'user' => $user,
            'token' => $user->createToken('auth_token')->plainTextToken,
            'role' => $user->role,
        ];
    }
}