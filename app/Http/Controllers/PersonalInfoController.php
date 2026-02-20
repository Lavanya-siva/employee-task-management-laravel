<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalInfo;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\ValidationException;

class PersonalInfoController extends Controller
{
     use AuthorizesRequests;
    public function savePersonalInfo(Request $request)
    {     
      
        $user = $request->user('sanctum');
        try {
        $request->validate([
        'proof_type' => 'required',
        'id_number' => 'required|string|unique:personal_infos,id_number',
        'kra_pin' => 'required|string|unique:personal_infos,kra_pin',
        'date_of_birth' => 'required|date',
        'nationality' => 'required|string',
        'country_residence' => 'required|string',
        'country_birth' => 'required|string',
        'gender' => 'required|in:Male,Female,Others',
        'employment_status' => 'required|in:Employed,Unemployed,SelfEmployed',
        ]);
        }    catch (ValidationException $e) {
             return response()->json([
            'success' => false,
            'errors' => $e->errors()
            ], 422);
        }
        $personalInfo = PersonalInfo::create([
            'user_id' => $user->id,
            'proof_type' => $request->proof_type,
            'id_number' => $request->id_number,
            'kra_pin' => $request->kra_pin,
            'date_of_birth' => $request->date_of_birth,
            'nationality' => $request->nationality,
            'country_residence' => $request->country_residence,
            'country_birth' => $request->country_birth,
            'gender' => $request->gender,
            'employment_status' => $request->employment_status,
        ]);

        $user->registration_status = 'personal_info';
        $user->save();

        return response()->json([
            'message' => 'Personal info saved',
            'user' => $user,
            'personal_info' => $personalInfo
        ]);
    }

}