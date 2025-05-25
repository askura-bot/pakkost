<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!auth()->check()) {
            return redirect()->route('login'); // Redirect ke login jika belum login
        }

        if (auth()->user()->role !== $role) {
            // Return view custom dengan status code 403
            return response()->view('errors.403', [
                'exception' => new \Exception('Anda tidak memiliki akses ke halaman ini')
            ], 403);
        }
    

        return $next($request);
    }
}
