<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRolePermissionAssignedUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles, $permissions)
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Access denied');
        }

        // Check roles
        if ($roles && !$user->hasAnyRole(explode('|', $roles))) {
            abort(403, 'Access denied for your role');
        }

        // Check permissions
        if ($permissions && !$user->hasAnyPermission(explode('|', $permissions))) {
            abort(403, 'Access denied for your permissions');
        }

        return $next($request);
    }
}