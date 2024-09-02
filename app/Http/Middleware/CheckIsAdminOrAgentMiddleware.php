<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIsAdminOrAgentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {

            if (! auth()->user()?->is_admin) {
                Auth::logout();
                session()->invalidate();
                return redirect('/dashboard/login');
            } else if (auth()->user()->role != 'agent') {
                Auth::logout();
                session()->invalidate();
                return redirect('/dashboard/login');
            }else
                return $next($request);
        }
        return $next($request);
    }
}
