<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    // Show signup form
    public function showSignupForm()
    {
        return view('auth.signup');  // You need to create this 'signup.blade.php' in the 'auth' folder.
    }

    // Process signup form submission
    public function processSignup(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Create user
        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Log in the user
        Auth::login($user);

        // Redirect to welcome page
        return redirect()->route('welcome');
    }

    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');  // Create a login form here 'login.blade.php' in 'auth' folder
    }

    // Process login form submission
    public function processLogin(Request $request)
    {
        // Validate login inputs
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($validated)) {
            // If successful, redirect to the welcome page
            return redirect()->route('welcome');
        }

        // If failed, redirect back with an error
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Welcome page (after login or signup)
    public function welcome()
    {
        return view('welcome');  // Display the welcome page after login/signup
    }
}
