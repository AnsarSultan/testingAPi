<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Laravel\Sanctum\Token;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\PersonalAccessToken;
class CheckTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['message' => 'Access Denied: No token provided'], 401);
        }

        $accessToken = PersonalAccessToken::findToken($token);

        if (!$accessToken ) {
            return response()->json(['message' => 'Access Denied: Invalid or expired token'], 401);
        }

        $request->setUserResolver(fn () => $accessToken->tokenable);
       
       

        return $next($request);
        
    }
}
