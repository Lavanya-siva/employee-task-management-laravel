<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authenticate
{
    public function handle(Request $request, Closure $next)
    { 
    $user = $request->user('sanctum');
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated!!'], 401);
        }
         return $next($request);
}
}