<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;


    protected $table = 'attendances';


    protected $fillable = [
        'user_id',
        'date',
        'check_in',
        'check_out',
        'status',
    ];


    protected $casts = [
        'date' => 'date',
    ];


    /**
     * Attendance belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Scope: Get present employees
     */
    public function scopePresent($query)
    {
        return $query->where('status', 'Present');
    }


    /**
     * Scope: Get absent employees
     */
    public function scopeAbsent($query)
    {
        return $query->where('status', 'Absent');
    }


    /**
     * Scope: Current user's attendance
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}