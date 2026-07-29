<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;


    protected $table = 'leave_requests';


    protected $fillable = [
        'user_id',
        'from_date',
        'to_date',
        'reason',
        'status',
        'approved_by',
        'approved_at',
    ];


    protected $casts = [
        'from_date' => 'date',
        'to_date' => 'date',
        'approved_at' => 'datetime',
    ];


    /**
     * Leave request belongs to employee
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Leave approved by manager/admin
     */
    public function approver()
    {
        return $this->belongsTo(
            User::class,
            'approved_by'
        );
    }


    /**
     * Scope pending requests
     */
    public function scopePending($query)
    {
        return $query->where(
            'status',
            'Pending'
        );
    }


    /**
     * Scope approved requests
     */
    public function scopeApproved($query)
    {
        return $query->where(
            'status',
            'Approved'
        );
    }


    /**
     * Scope rejected requests
     */
    public function scopeRejected($query)
    {
        return $query->where(
            'status',
            'Rejected'
        );
    }


    /**
     * Scope current user's leaves
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where(
            'user_id',
            $userId
        );
    }
}