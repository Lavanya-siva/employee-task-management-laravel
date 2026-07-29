<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class UserPersonalInfo extends Model
{


    protected $table = 'user_personal_infos';



    protected $fillable = [

        'user_id',
        'dob',
        'phone',
        'gender',
        'address',
        'profile_photo'

    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }


}