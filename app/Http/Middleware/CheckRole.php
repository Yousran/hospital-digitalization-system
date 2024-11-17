<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();
    
        if (!$user) {
            abort(401, 'User not authenticated');
        }
    
        $userRoles = $user->roles->pluck('name')->toArray();

        if (!array_intersect($roles, $userRoles)) {
            abort(403, 'Unauthorized');
        }
    
        return $next($request);
    }

}
