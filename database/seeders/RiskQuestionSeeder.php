<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RiskQuestion;
use Carbon\Carbon;

class RiskQuestionSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        RiskQuestion::insert([
            [
                'question_text' => 'What is your primary investment goal?',
                'option1_text' => 'Capital protection',
                'option1_risk_score' => 1,
                'option2_text' => 'Stable income',
                'option2_risk_score' => 3,
                'option3_text' => 'Moderate growth',
                'option3_risk_score' => 2,
                'option4_text' => 'High growth',
                'option4_risk_score' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question_text' => 'How long do you plan to stay invested?',
                'option1_text' => 'Less than 1 year',
                'option1_risk_score' => 3,
                'option2_text' => '1–3 years',
                'option2_risk_score' => 1,
                'option3_text' => '3–5 years',
                'option3_risk_score' => 4,
                'option4_text' => 'More than 5 years',
                'option4_risk_score' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question_text' => 'How would you react if your investment value drops by 20%?',
                'option1_text' => 'Sell immediately',
                'option1_risk_score' => 4,
                'option2_text' => 'Wait for recovery',
                'option2_risk_score' => 2,
                'option3_text' => 'Hold and monitor',
                'option3_risk_score' => 1,
                'option4_text' => 'Invest more',
                'option4_risk_score' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question_text' => 'What percentage of your income are you comfortable investing?',
                'option1_text' => 'Less than 10%',
                'option1_risk_score' => 4,
                'option2_text' => '10–25%',
                'option2_risk_score' => 2,
                'option3_text' => '25–50%',
                'option3_risk_score' => 3,
                'option4_text' => 'More than 50%',
                'option4_risk_score' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question_text' => 'Which investment option do you prefer?',
                'option1_text' => 'Fixed deposits / bonds',
                'option1_risk_score' => 1,
                'option2_text' => 'Balanced mutual funds',
                'option2_risk_score' => 2,
                'option3_text' => 'Equity mutual funds',
                'option3_risk_score' => 3,
                'option4_text' => 'Stocks / crypto',
                'option4_risk_score' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
