<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => [
                'required',
                'min:8',            // at least 8 characters
                // 'regex:/[A-Z]/',    // must contain uppercase
                'regex:/[a-z]/',    // must contain lowercase
                'regex:/[0-9]/',    // must contain a number
                'regex:/[@$!%*?&]/' // must contain a special character
            ]
        ]);


        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        // 1. Log out user from default guard
        Auth::guard('web')->logout();

        // 2. Clear all session data
        $request->session()->flush();

        // 3. Invalidate current session ID
        $request->session()->invalidate();

        // 4. Regenerate CSRF token
        $request->session()->regenerateToken();

        // 5. Redirect to login page with optional success message
        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }
}
