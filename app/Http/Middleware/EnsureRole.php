<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Tambahkan impor ini

class EnsureRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $roles  // Daftar role yang diharapkan dari route (misal: 'founder' atau 'sales,spg')
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $roles): Response
    {
        // 1. Dapatkan user yang sedang login (gunakan Auth::user() sebagai fallback)
        $user = $request->user() ?? Auth::user();
        
        // Cek jika user tidak terautentikasi (seharusnya ditangani oleh middleware 'auth', tapi sebagai pengaman)
        if (!$user) {
            return abort(403, 'Akses ditolak. Anda belum login.');
        }

        // Ambil role user dan pastikan nilainya ada
        $userRole = $user->role ?? null; 

        if (!$userRole) {
            return abort(403, 'Akses ditolak. Informasi peran pengguna tidak ditemukan.');
        }

        // 2. Proses Role: Ubah daftar role yang diizinkan dan role user menjadi huruf kecil

        // Daftar role yang diizinkan dari route (misal: "sales,spg")
        $allowedRoles = explode(',', $roles);
        
        // Konversi semua role yang diizinkan menjadi huruf kecil
        $allowedRolesLower = array_map('strtolower', $allowedRoles);
        
        // Konversi role user menjadi huruf kecil (misal: 'SPG' menjadi 'spg')
        $userRoleLower = strtolower($userRole); 

        // 3. Cek Otorisasi: Apakah role user ada dalam daftar role yang diizinkan?
        if (in_array($userRoleLower, $allowedRolesLower)) {
            // Role user (misal: 'spg') diizinkan, lanjutkan request
            return $next($request);
        }

        // Jika tidak diizinkan, tolak akses.
        return abort(403, 'AKSES DITOLAK. ANDA TIDAK MEMILIKI IZIN UNTUK HALAMAN INI.');
    }
}