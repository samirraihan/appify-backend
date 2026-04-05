<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ApiTokenAuth
{
    public function handle(Request $request, Closure $next)
    {
        $header = $request->bearerToken();
        if (!$header) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        // If the token looks like a JWT (has dots), try JWTAuth first
        if (strpos($header, '.') !== false) {
            try {
                $user = JWTAuth::setToken($header)->toUser();
                if ($user) {
                    auth()->setUser($user);
                    return $next($request);
                }
            } catch (JWTException $e) {
                return response()->json(['message' => 'Invalid token'], 401);
            }
        }

        // Fallback to legacy api_token column
        $user = User::where('api_token', $header)->first();
        if (!$user) {
            return response()->json(['message' => 'Invalid token'], 401);
        }

        auth()->setUser($user);
        return $next($request);
    }
}
