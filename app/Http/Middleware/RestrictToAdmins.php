<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestrictToAdmins
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // بررسی اینکه کاربر لاگین کرده باشد
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // بررسی اینکه کاربر ادمین هست یا نه
        if (Auth::user()->role !== 'admin') {
            abort(403, 'دسترسی غیرمجاز - شما ادمین نیستید');
        }

        return $next($request);
    }
}