<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Providers\RouteServiceProvider; // Wajib di-import

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // 1. Autentikasi user (memvalidasi kredensial)
        $request->authenticate();

        // 2. Regenerate session untuk keamanan
        $request->session()->regenerate();

        $user = Auth::user();
        
        // Ambil role, LAKUKAN TRIM & LOWERCASE untuk perbandingan yang aman
        $role = strtolower(trim($user->role)); 

        // 3. Redirect berdasarkan role menggunakan SWITCH
        switch ($role) {
            case 'founder':
                return redirect()->intended(route('founder.dashboard'));
            
            case 'manager':
                return redirect()->intended(route('manager.dashboard'));

            case 'sales':
                return redirect()->intended(route('sales.dashboard'));

            case 'spg':
                // ROLE SPG DIARAHKAN KE RUTE SPESIFIK
                return redirect()->intended(route('spg.dashboard'));
            
            default:
                // Jika role tidak cocok atau kosong
                return redirect()->intended(RouteServiceProvider::HOME);
        }
    }

    /**
     * Destroy an authenticated session (Logout).
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
