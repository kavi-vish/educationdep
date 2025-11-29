<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
    $request->session()->regenerate();

    // === FORCE REDIRECT BASED ON EMAIL OR ROLE ===
    $user = auth()->user();

    // Option 1: Check by email (100% reliable)
    if ($user->email === 'admin@sample.com') {
        return redirect()->route('admin.dashboard');
    }

    // Option 2: Check by role (if you fix DB later)
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    // Everyone else
    return redirect('/dashboard');
    }

    public function destroy(): RedirectResponse
    {
        Auth::guard('web')->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }
}