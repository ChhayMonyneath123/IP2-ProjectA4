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
        // Attempt to authenticate the user
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            // Redirect to the home page for all users
            return redirect()->route('welcome');
        }

        // If authentication fails, redirect back with error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Log out the user and invalidate the session
        Auth::guard('web')->logout();

        // Invalidate and regenerate the session token for security
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the home page after logging out
        return redirect('/');
    }
}
