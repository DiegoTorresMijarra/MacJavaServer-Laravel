<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRolMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()&&Auth::user()->rol === 'USER') {
            return $next($request);
        }
        throw new AuthorizationException('Solo USER puede acceder');
        // abort(Response::HTTP_FORBIDDEN);
    }
}
