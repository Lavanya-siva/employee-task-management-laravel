<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authenticate
{
    public function handle(Request $request, Closure $next)
    {
        $accessToken = session('access_token');

        if (!$accessToken) {
            return response()->json([
                'message' => 'Unauthenticated!!'
            ], 401);
        }

        return $next($request);
    }
}