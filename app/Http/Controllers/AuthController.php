<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException; 
use App\Events\UserRegistered;
use Illuminate\Support\Facades\Log;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        try{
            $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        } catch(ValidationException $e){

        Log::warning('Validation failed during login', [
       'email' => $request->email,
       'errors' => $e->errors()
        ]);

        return response()->json([
        'success' => false,
        'errors' => $e->errors()
    ], 422);

    }
     Log::info('Login attempt', [
        'email' => $request->email
    ]);
        $user = User::where('email', $request->email)->first();

        if (!$user||!Hash::check($request->password, $user->password)) {
            Log::notice('Invalid login credentials', [
            'email' => $request->email
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }
         if ($user->registration_status !== 'otp_verified') {
             Log::warning('Login blocked: OTP not verified', [
            'user_id' => $user->id,
            'status' => $user->registration_status
             ]);
            return response()->json([
                'success' => false,
                'message' => 'Please verify your OTP before logging in '
            ], 403);
        }
         Log::info('Login successful', [
        'user_id' => $user->id,
        'email' => $user->email
         ]);
        event(new UserRegistered($user));
       $token = $user->createToken('VukaAPI-login');
       $token->accessToken->expires_at = Carbon::now()->addMinutes(config('sanctum.expiration'));
       $token->accessToken->save();
        return response()->json([
            'success' => true,
            'message' => 'Login successful, now add Personal Info',
            'user' => $user,
            'access_token' => $token->plainTextToken,
            'token_type' => 'Bearer',
            'expires_in' => (config('sanctum.expiration') * 60).' sec',
        ], 200);
    }

}
