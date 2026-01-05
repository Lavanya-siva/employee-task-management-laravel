<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CheckSanctumTokenExpiry
{
public function handle(Request $request, Closure $next){

$user = $request->user('sanctum'); // after auth:sanctum

if (!$user) {
    return response()->json([
        'message' => 'Unauthenticated!!'
    ], 401);
}

$token = $user->currentAccessToken();

if (!$token) {
    return response()->json([
        'message' => 'Invalid Token'
    ], 401);
}

if ($token->expires_at && now()->greaterThan($token->expires_at)) {
    $token->delete();

    return response()->json([
        'message' => 'Token expired'
    ], 401);
}

return $next($request);

    }
}
