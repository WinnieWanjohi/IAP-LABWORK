<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // For now, allow all access
        // In production, you would check: Auth::check() && Auth::user()->role->slug === 'admin'
        return $next($request);
    }
}