<?php

namespace App\Http\Middleware;

use App\Http\Resources\UserResource;

use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = new UserResource(auth()->user());

        $roles = $user->roles;

        foreach ($roles as $role)
        {
            if ($role->environment === 'admin') {
                return $next($request);
            }
        }
        return response()->json(['error' => 'Unauthorized action'], 403);
    }
}
