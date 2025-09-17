<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Pengecekan: Apakah user sudah login? DAN Apakah rolenya cocok?
        if (!Auth::check() || Auth::user()->role !== $role) {
            
            // ======================================================
            // Logout pengguna terlebih dahulu
            // ======================================================
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();
            // ======================================================

            // Arahkan ke halaman login dengan pesan error
            return redirect('/login')->with('error', 'Anda tidak memiliki hak akses untuk halaman ini.');
        }

        return $next($request);
    }
}