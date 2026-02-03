<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'email_hash',
        'password',
        'role',
        'avatar_url',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'email_hash',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'name' => 'encrypted',
            'email' => 'encrypted',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($user) {
            if ($user->isDirty('email')) {
                $user->email_hash = hash('sha256', $user->email);
            }
        });
    }

    public function profile()
    {
        return $this->hasOne(MemberProfile::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function activeSubscriptions()
    {
        return $this->hasOne(Subscription::class)->where('status', 'active');
    }
}