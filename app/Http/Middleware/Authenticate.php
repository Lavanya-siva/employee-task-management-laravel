<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class Authenticate
{
    public function handle(Request $request, Closure $next)
    {
        $accessToken = session('access_token');

        if (!$accessToken) {
            return redirect()->route('login')->with('error', 'Please login to continue.');
        }

        $token = PersonalAccessToken::findToken($accessToken);

        if (!$token) {
            return redirect()->route('login')->with('error', 'Please login to continue.');
        }

        return $next($request);
    }
}