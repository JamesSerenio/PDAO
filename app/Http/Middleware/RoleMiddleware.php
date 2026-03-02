<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        $user = $request->user();

        // not logged in
        if (!$user) {
            abort(403);
        }

        // if you store role in users.role
        if (($user->role ?? null) !== $role) {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}