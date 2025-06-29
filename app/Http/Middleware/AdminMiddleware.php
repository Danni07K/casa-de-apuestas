<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('welcome')->with('error', 'Acceso no autorizado.');
        }

        // Verificar el rol directamente en la base de datos
        $userId = Auth::id();
        $isAdmin = \DB::table('users')->where('id', $userId)->where('role', 'admin')->exists();
        if (!$isAdmin) {
            return redirect()->route('welcome')->with('error', 'Acceso no autorizado.');
        }

        return $next($request);
    }
} 