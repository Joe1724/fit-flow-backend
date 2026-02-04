<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberProfile extends Model
{
    protected $fillable = [
        'user_id',
        'phone',
        'dob',
        'gender',
        'emergency_contact',
        'medical_history',
        'access_card_id',
        'bio'
    ];

    protected $casts = [
        'medical_history' => 'encrypted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
