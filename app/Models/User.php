<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory; 


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasFactory, HasApiTokens;
    protected $fillable = [
        'firstname','middlename','surname','email','password','phone_no','terms_cond','registration_status', 'role',
        'manager_id'
    ];

    public function otp()
    {
        return $this->hasOne(OtpVerification::class, 'user_id');
    }

    public function personalInfo()
    {
        return $this->hasOne(PersonalInfo::class, 'user_id');
    }
    public function otpVerification()
    {
        return $this->hasOne(OtpVerification::class);
    }
}


