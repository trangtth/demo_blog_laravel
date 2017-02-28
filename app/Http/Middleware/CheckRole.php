<?php

namespace App\Http\Middleware;

use Closure;

use Auth;
use App\User;
use Illuminate\Support\Facades\Session;


class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $arrayRoles = explode("|", $role);
        $isAccess = false;
        foreach ($arrayRoles as $r) {
            if (Auth::user()->role == $r) {
                $isAccess = true;
                break;
            }
        }

        if ($isAccess) {
            return $next($request);
        } else {
            return redirect('/');
        }

    }
}
