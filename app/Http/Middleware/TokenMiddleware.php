<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class TokenMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $authHeader = $request->header('Authorization');

        \Log::info('Authorization Header:', ['Authorization' => $authHeader]);

        if (!$authHeader) {
            \Log::warning('Unauthorized access: No Authorization header');
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Support 'Bearer token'
        if (str_starts_with($authHeader, 'Bearer ')) {
            $token = substr($authHeader, 7); // remove 'Bearer ' prefix
        } else {
            $token = $authHeader;
        }

        if ($token !== 'vg@123') {
            \Log::warning('Unauthorized access: Invalid token', ['Token' => $token]);
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
