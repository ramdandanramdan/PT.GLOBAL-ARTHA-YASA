<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role  // Role yang diharapkan dari route (misal: 'founder')
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Pastikan user sudah login
        if (!$request->user()) {
            abort(403, 'Akses ditolak. Anda belum login.');
        }

        // Ambil string role dari user. Diasumsikan kolom 'role' ada di tabel users.
        $userRole = $request->user()->role;

        // 2. Cek apakah role user sesuai (case-insensitive)
        // Jika kolom role kosong/null, atau tidak sesuai, tolak akses.
        if (!$userRole || strtolower($userRole) !== strtolower($role)) {
            abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk halaman ini.');
        }

        return $next($request);
    }
}