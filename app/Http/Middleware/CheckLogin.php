<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Users;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userId = session('user_id');
        
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        // Verify user exists and is logged in
        $user = Users::where('user_id', $userId)->where('is_login', true)->first();
        
        if (!$user) {
            session()->flush();
            return redirect()->route('login')->with('error', 'Your session has expired. Please login again.');
        }

        return $next($request);
    }
}
