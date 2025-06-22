<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        if (Auth::check()) {
            $role = Auth::user()->role;

            switch ($role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'author':
                    return redirect()->route('author.dashboard');
                case 'user':
                    return redirect()->route('user.dashboard');
            }
        }

        // ✅ Wajib: Lanjutkan request jika belum login
        return $next($request);
    }
}
