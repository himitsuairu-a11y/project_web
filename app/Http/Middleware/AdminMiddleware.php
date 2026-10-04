<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && (Auth::user()->role === UserRole::ADMIN || Auth::user()->role === UserRole::ADMIN->value || (isset(Auth::user()->role->value) && Auth::user()->role->value === UserRole::ADMIN->value))) {
            return $next($request);
        }

        abort(403, 'Unauthorized access.');
    }
}
