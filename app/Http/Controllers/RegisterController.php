<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Show registration form
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:SuperAdmin,teacher,student',
            'profile_pic' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // max 2MB
        ]);
        // Handle file upload
        $profilePicPath = null;
        if ($request->hasFile('profile_pic')) {
            $profilePicPath = $request->file('profile_pic')->store('profile_pics', 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_pic' => $profilePicPath, // save file path in DB
        ]);

        $user->assignRole($request->role);

        // Redirect to login page instead of logging in
        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }
}
