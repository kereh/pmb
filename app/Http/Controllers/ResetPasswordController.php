<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller {
    public function index() {
        return view('auth.lupa-password', ['title' => 'Lupa Password']);
    }

    public function reset($token) {
        return view('auth.reset-password', [
            'title' => 'Ganti Password',
            'token' => $token,
        ]);
    }

    public function send(Request $request) {
        $validated = $request->validate(['email' => 'required|email:dns']);

        $status = Password::sendResetLink($validated);

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', [
                'type' => 'alert-success',
                'message' => 'Reset Password link berhasil dikirim!'
            ])
            : back()->with('status', [
                'type' => 'alert-danger',
                'message' => 'Reset Password link gagal dikirim! Coba lagi nanti.'
            ]);
    }

    public function update(Request $request) {
        $validated = $request->validate(['password' => 'required|min:4|confirmed', 'token' => 'required']);

        // dd($validated);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
                Auth::login($user);
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('auth.login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
