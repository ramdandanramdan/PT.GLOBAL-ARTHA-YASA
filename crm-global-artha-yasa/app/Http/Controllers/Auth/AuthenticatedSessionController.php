<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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

        // 3. Redirect berdasarkan role (Membandingkan string role untuk menghindari ErrorException)
        if ($user->role && strtolower($user->role) === 'founder') {
            return redirect()->route('founder.dashboard');
        }

        // 4. Redirect default untuk user lain (misalnya, sales)
        return redirect()->intended(route('dashboard'));
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