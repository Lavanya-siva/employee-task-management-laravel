<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'document_category',
        'document_name',
        'file_type',
        'file_path',
        'current_status',
        'uploaded_at'
    ];

    public $timestamps = true;
}
