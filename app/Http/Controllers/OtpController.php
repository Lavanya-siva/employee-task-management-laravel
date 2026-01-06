<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OtpVerification;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Jobs\SendOtpJob;
use Illuminate\Support\Facades\Log;


class OtpController extends Controller{
    use AuthorizesRequests;
    public function verifyOtp(Request $request){
    try{
        $request->validate([
        'email' => 'required|email',
        'otp_code' => 'required|digits:6',
    ]);
    } catch(ValidationException $e){
         Log::notice('Validation failed while Verifying OTP', [
        'email' => $request->email,
        'errors' => $e->errors()
        ]);
     return response()->json([
        'success' => false,
        'errors' => $e->errors()
    ], 422);
    }
    $user = User::where('email', $request->email)->first(); // get user details by email 
    //no user found
    if (!$user) {
        Log::warning('OTP verification for non-existing user', [
            'email' => $request->email
        ]);

        return response()->json([
            'success' => false,
            'message' => 'User not found'
        ], 404);
    }

    //already verified
        if ($user->registration_status === 'otp_verified') {
            return response()->json([
                'message' => 'OTP already verified'
            ], 400);
        }

    $maxChance = 3;
   
    // get latest OTP for this user
    $otpRecord = OtpVerification::where('user_id', $user->id)
        ->latest()
        ->first();

    if (!$otpRecord) {
        return response()->json(['message' => 'No OTP found. Please request a new one.'], 404);
    }

    // Check max attempts
    if ($otpRecord->attempts >= $maxChance) {
         Log::warning('Max OTP attempts reached', [
            'user_id' => $user->id
        ]);
        return response()->json([
            'success' => false,
            'message' => 'Too many attempts. Please try again later.'
        ], 429); 
    }

    // Check expiration
    if ($otpRecord->expires_at < now()) {
        Log::info('OTP expired', [
            'user_id' => $user->id
        ]);
        return response()->json(['message' => 'OTP expired'], 422);
    }

    // Check OTP
    if ($otpRecord->otp_code != $request->otp_code) {
        $otpRecord->increment('attempts'); // increment attempts on wrong OTP
        Log::notice('Invalid OTP entered', [
            'user_id' => $user->id
        ]);
        return response()->json(['message' => 'Invalid OTP'], 422);
    }

    $otpRecord->verified = true;
    $otpRecord->attempts = 0; 
    $otpRecord->save();

    $otpRecord->user->registration_status = 'otp_verified';
    $otpRecord->user->save();
    

    Log::info('OTP verified successfully', [
        'user_id' => $user->id
    ]);

    return response()->json([
        'success' => true,
        'message' => 'OTP verified successfully'
    ], 200);
}

    public function resendOtp(Request $request)
    {
        try{
            $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);
        } catch(ValidationException $e){
         Log::notice('Validation failed while resending OTP', [
        'email' => $request->email,
        'errors' => $e->errors()
        ]);
        return response()->json([
        'success' => false,
        'errors' => $e->errors()
        ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid Credentials'
            ], 401);
        }
        //already verified
       if ($user->registration_status !== 'started') {
       return response()->json([
        'message' => 'OTP already verified or cannot be resent at this stage'
       ], 400);
       }

        
        //generate new otp
        $otp = rand(100000, 999999);
        $otpRecord = OtpVerification::updateOrCreate(
        ['user_id' => $user->id],
        [
        'otp_code' => $otp,
        'sent_at'=>now(),
        'expires_at' => now()->addMinutes(10),
        'attempts' => 0,
        'verified' => false
        ]
        );
        // send otp
       SendOtpJob::dispatch($user, $otp, 'Your OTP Verification Code - Resend');

        /* Mail::send('emails.otp-verification', [
        'user' => $user,
        'otp' => $otp
        ], function ($message) use ($user) {
        $message->to($user->email)
                ->subject('Your OTP Verification Code-Resend');
        });*/
        return response()->json([
            'success' => true,
            'message' => 'New OTP is being sent'
        ]);
    }
}
