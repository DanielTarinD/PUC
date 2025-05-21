<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle($request, Closure $next, $role, $permission = null)
    {
        $roles = is_array($role)
            ? $role
            : explode('|', $role);

        if (!$request->user()->hasRole($roles)) {
            abort(404);
        }

        if ($permission !== null && !$request->user()->can($permission)) {
            abort(404);
        }

        return $next($request);
    }
}
