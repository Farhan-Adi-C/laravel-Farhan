<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;

class ForgotPasswordController extends Controller
{
    // Menampilkan form lupa password
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    // Mengirim link reset password ke email pengguna
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::ResetLinkSent
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    // Menampilkan form reset password
    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    // Melakukan reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
        
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );

        return $status === Password::PasswordReset
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
