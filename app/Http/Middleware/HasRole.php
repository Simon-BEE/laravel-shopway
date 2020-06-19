<?php

namespace App\Http\Middleware;

use Closure;

class HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, string $role, string $permission = null)
    {
        //Example on route ['middleware' => ['auth', 'role:manager']]
        abort_if(!auth()->user()->hasRoles($role), 404);

        //Example on route ['middleware' => ['auth', 'role:manager,create-user']]
        abort_if(!is_null($permission) && !auth()->user()->can($permission), 404);

        return $next($request);
    }
}
