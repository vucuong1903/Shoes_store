<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Thêm dòng này

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Log để kiểm tra lý do chuyển hướng
        Log::info('Redirecting user', ['user' => Auth::user()]);

        return redirect()->route('welcome')->with('error', 'You do not have admin access.');
    }
}
