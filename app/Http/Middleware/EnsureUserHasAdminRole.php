<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!in_array('ROLE_ADMIN', $request->user()->role)) {
            // Redirige l'utilisateur s'il n'a pas le rôle admin
            return redirect('/');
        }

        return $next($request);
    }
}
