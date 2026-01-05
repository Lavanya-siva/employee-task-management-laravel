<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiskAssessment extends Model
{
    protected $fillable = [
        'question_id','users_id',
        'option_selected','risk_score','submitted_at'
    ];
}

