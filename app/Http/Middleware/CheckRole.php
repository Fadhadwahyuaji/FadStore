<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
{
    if (!auth()->check()) {
        return redirect('login');
    }

    $user = auth()->user();

    foreach ($roles as $role) {
        if ($user->role === $role) {
            return $next($request);
        }
    }

    abort(403, 'Unauthorized action.');
}
}
