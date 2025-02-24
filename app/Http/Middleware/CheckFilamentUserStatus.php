<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class CheckFilamentUserStatus
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = Auth::user();

            if (!$user || !$user->is_active) {
                Auth::logout();
                return redirect()->route('login')
                    ->with('error', 'Cuenta inactiva. Contacta al administrador.');
            }

            if ($request->is('admin*') && Gate::denies('access-admin', $user)) {
                Log::warning('Intento de acceso no autorizado al panel admin por usuario: ' . $user->id);
                return redirect()->route('dashboard')
                    ->with('error', 'No tienes permisos suficientes para acceder al panel administrativo.');
            }

            return $next($request);
        } catch (\Exception $e) {
            Log::error('Error en middleware: ' . $e->getMessage());
            return redirect()->route('login')
                ->with('error', 'Error de autenticación. Inténtalo de nuevo.');
        }
    }
}
