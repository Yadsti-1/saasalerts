<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || Gate::denies('access-admin', Auth::user())) {
            return redirect('/')->with('error', 'Acceso no autorizado.');
        }

        return $next($request);
    }
}
