<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\OtpVerification;
use Illuminate\Validation\ValidationException;
use App\Jobs\SendOtpJob;
use Illuminate\Support\Facades\Log;


class CreateAccountController extends Controller
{

 public function createAccount(Request $request)
{ 
    
    try{
        $request->validate([
        'firstname' => 'required|string',
        'middlename' => 'nullable|string',
        'surname' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'phone_no' => 'required|string',
        'password' => 'required|min:8',
        'terms_cond' => 'required|in:1',
        'role'=>'required'
    ]);
    } catch(ValidationException $e){
        Log::warning('Validation failed during account creation', [
            'error' => $e->getMessage()
        ]);
       return response()->json([
        'success' => false,
        'errors' => $e->errors()
    ], 422);
    }
   

    $user = User::create([
        'firstname' => $request->firstname,
        'middlename' => $request->middlename,
        'surname' => $request->surname,
        'email' => $request->email,
        'phone_no' => $request->phone_no,
        'password' => Hash::make($request->password),
        'terms_cond' => $request->terms_cond,
        'role'=>$request->role,
    ]);
    $otp = rand(100000, 999999);

    OtpVerification::create([
        'user_id' => $user->id,
        'otp_code' => $otp,
        'sent_at' => now(),
        'expires_at' => now()->addMinutes(10),
    ]);
     
     SendOtpJob::dispatch($user, $otp);
   //Mail::to($user->email)->send(new OtpMail($user, $otp)); // send mail-Mail.php-view
    return response()->json([
        'success' => true,
        'message' => 'Account created. Verification email with otp is being sent.',
    ], 201);
}

}

