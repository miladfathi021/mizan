<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     *
     * @param Request $request
     * @param Closure $next
     * @param $role
     * @param null $permission
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role, $permission = null)
    {
        if (!$request->user('api')->hasRole($role)) {
            return response()->json([
                'message' => 'You are not allowed access',
                'status' => 401
            ], 401);
        }

        if ($permission !== null && !$request->user('api')->can($permission)) {
            return response()->json([
                'message' => 'You are not allowed access',
                'status' => 401
            ], 401);
        }
        return $next($request);
    }
}
