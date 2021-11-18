<?php

namespace App\Http\Middleware;

use App\Http\Controllers\LoginController;
use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!(\Auth::guard('web')->check() && LoginController::check_user_has_super_permission(\Auth::user()->role->level)))
            return redirect()->route('login');
        return $next($request);
    }
}
