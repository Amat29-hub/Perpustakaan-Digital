<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // kepala perpus bebas akses
        if ($user->role == 'kepala_perpus') {
            return $next($request);
        }

        // jika role tidak sesuai
        if ($user->role != $role) {

            if ($user->role == 'anggota') {
                return redirect()->route('home');
            }

            if ($user->role == 'petugas') {
                return redirect()->route('admin.dashboard');
            }

        }

        return $next($request);
    }
}