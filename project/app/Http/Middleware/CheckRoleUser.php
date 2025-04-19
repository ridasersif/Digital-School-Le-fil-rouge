<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleUser
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if($user){
            if ( $user->role_id == 4) {
                return redirect()->route('select-role');
            }
        }
        return $next($request);
    }
}
