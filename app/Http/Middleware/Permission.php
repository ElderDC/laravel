<?php

namespace App\Http\Middleware;

use App\Http\Resources\UserResource;

use Closure;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param array  $permissions
     * @return mixed
     */
    public function handle($request, Closure $next, ...$permissions)
    {
        $roles = auth()->user()->roles;

        foreach ($roles as $role)
        {
            foreach ($permissions as $permission)
            {
                if (in_array($permission, $role->permission_slugs)) {
                    return $next($request);
                }
            }
        }
        return response()->json(['error' => 'Unauthorized action'], 403);
    }
}
