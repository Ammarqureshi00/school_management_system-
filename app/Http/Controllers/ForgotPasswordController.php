<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    // Show the form
    public function showLinkRequestForm()
    {
        return view('auth.forgetpassword'); // create this view
    }
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Send reset link
        $status = Password::sendResetLink(
            $request->only('email')
        );


        if ($status === Password::RESET_LINK_SENT) {
            // Success case
            return back()->with('success', __($status));
        } else {
            // Error case
            return back()->withErrors(['email' => __($status)]);
        }

        // return $status === Password::RESET_LINK_SENT
        //     ? back()->with('success', __($status))
        //     : back()->withErrors(['email' => __($status)]);
    }
}
