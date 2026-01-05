<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiskQuestion extends Model
{
    protected $fillable = [
        'question_text',
        'option1_text','option1_risk_score',
        'option2_text','option2_risk_score',
        'option3_text','option3_risk_score',
        'option4_text','option4_risk_score'
    ];
}
