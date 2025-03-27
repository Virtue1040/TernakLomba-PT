<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AttachAuthToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->header('Authorization') == null) {
            if ($token = $request->cookie(env("TOKEN_NAME", "auth_token"))) {
                $request->headers->set('Authorization', 'Bearer ' . $token);
            }
        }
        
        return $next($request);
    }
}
