<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiskQuestion;
use App\Models\RiskAssessment;
use Illuminate\Support\Facades\Validator;

class RiskAssessmentController extends Controller{
    // Get all risk questions
   public function getQuestions(Request $request){
    $user = $request->user('sanctum'); 

    if (!in_array($user->registration_status, ['documents_uploaded', 'documents_reuploaded'])) {
        return response()->json([
            'success' => false,
            'message' => 'Access denied. Document not uploaded yet.'
        ], 403);
    }

    return response()->json([
        'success' => true,
        'data' => \App\Models\RiskQuestion::all()
    ]);
    }


    // Submit answer for each question
    public function submitAnswer(Request $request)
    {
        $user=$request->user('sanctum'); 
        if (!in_array($user->registration_status, ['documents_uploaded', 'documents_reuploaded'])) {
        return response()->json([
            'success' => false,
            'message' => 'Access denied. Document not uploaded yet.'
        ], 403);
    }
        $validator = Validator::make($request->all(), [
        'question_id' => 'required|integer||between:1,5',
        'option_selected' => 'required|integer|between:1,4'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    $question = RiskQuestion::find($request->question_id);
    $score = match ($request->option_selected) {
         1 => $question->option1_risk_score,
          2 => $question->option2_risk_score, 
          3 => $question->option3_risk_score,
           4 => $question->option4_risk_score,
         };

        RiskAssessment::updateOrCreate(   // no duplicate row insertion 
            [
                'question_id' => $question->id,
                'users_id' => $request->user('sanctum')->id,
            ],
            [
                'option_selected' => $request->option_selected,
                'risk_score' => $score,
                'submitted_at' => now()
            ]
        );

        return response()->json([
            'success' => true,
            'risk_score' => $score
        ]);
    }

    // Get final risk profile
    public function finalRiskProfile(Request $request)
    {
          $user=$request->user('sanctum'); 
        if (!in_array($user->registration_status, ['documents_uploaded', 'documents_reuploaded'])) {
        return response()->json([
            'success' => false,
            'message' => 'Access denied. Document not uploaded yet.'
        ], 403);
    }
        $user = $request->user('sanctum');
        $totalScore = RiskAssessment::where('users_id', $user->id)
            ->sum('risk_score');
        if(!$totalScore){
            return response()->json([
            'success' => false,
            'message' => 'Please take risk assessment first.'
        ], 403);
        }

        $profile = match (true) {  // user input but call so true..
            $totalScore <= 8 => 'Low Risk Investor',
            $totalScore <= 16 => 'Moderate Risk Investor',
            $totalScore <= 24 => 'High Risk Investor',
            default => 'Very High Risk Investor',
        };
        $user->registration_status = 'risk_done';
        $user->save();
         
        return response()->json([
            'total_score' => $totalScore,
            'risk_profile' => $profile
        ]);
    }
}
