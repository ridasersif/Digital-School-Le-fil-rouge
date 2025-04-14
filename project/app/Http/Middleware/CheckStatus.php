<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckStatus
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        // $inctive=true;

        if ($user && $user->status !== 'active') {
            // return redirect()->route('home',compact('inctive'))->with("error", "Votre compte est désactivé. Veuillez contacter le support.");
            return redirect()->route('home')->with([
                'error' => "Votre compte est désactivé. Veuillez contacter le support.",
                'inctive' => true,
            ]); 
        }

        return $next($request);
    }
}
