<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use App\Events\UserRegistered;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
        } catch (ValidationException $e) {

            Log::warning('Validation failed during login', [
                'email' => $request->email,
                'errors' => $e->errors()
            ]);

            return back()
                ->withErrors($e->errors())
                ->withInput($request->only('email'));
        }

        Log::info('Login attempt', [
            'email' => $request->email
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {

            Log::notice('Invalid login credentials', [
                'email' => $request->email
            ]);

            return back()
                ->withErrors(['email' => 'Invalid credentials.'])
                ->withInput($request->only('email'));
        }

        if ($user->registration_status !== 'otp_verified') {

            Log::warning('Login blocked: OTP not verified', [
                'user_id' => $user->id,
                'status' => $user->registration_status
            ]);

            return back()
                ->withErrors(['email' => 'Please verify your OTP before logging in.'])
                ->withInput($request->only('email'));
        }

        Log::info('Login successful', [
            'user_id' => $user->id,
            'email' => $user->email
        ]);

        event(new UserRegistered($user));

        $token = $user->createToken('VukaAPI-login');
        $token->accessToken->expires_at = Carbon::now()->addMinutes(config('sanctum.expiration'));
        $token->accessToken->save();

        Auth::login($user);
        $request->session()->regenerate();

        // Store Token in Session
        session([
            'user_id' => $user->id,
            'user_role' => $user->role,
            'access_token' => $token->plainTextToken,
            'user_name' => trim(
                $user->firstname . ' ' .
                    ($user->middlename ? $user->middlename . ' ' : '')
            ),
        ]);

        return redirect()->route('dashboard');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function createAccount()
    {
        return view('auth.create-account');
    }

    public function otpVerify()
    {
        return view('auth.otp-verify');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Logged out successfully'
            );
    }
}