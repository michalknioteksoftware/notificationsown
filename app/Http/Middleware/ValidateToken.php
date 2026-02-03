<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');
        
        // Remove 'Bearer ' prefix if present
        if ($token && strpos($token, 'Bearer ') === 0) {
            $token = substr($token, 7);
        }
        
        $validToken = env('API_TOKEN');
        
        if (!$token || $token !== $validToken) {
            return response()->json([
                'error' => 'Unauthorized',
                'message' => 'Invalid or missing token'
            ], 401);
        }
        
        return $next($request);
    }
}
