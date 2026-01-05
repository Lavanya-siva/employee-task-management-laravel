<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException; 
use App\Events\UserRegistered;

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
        return response()->json([
        'success' => false,
        'errors' => $e->errors()
    ], 422);

    }

        $user = User::where('email', $request->email)->first();

        if (!$user||!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }
         if ($user->registration_status !== 'otp_verified') {
            return response()->json([
                'success' => false,
                'message' => 'Please verify your OTP before logging in '
            ], 403);
        }
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
