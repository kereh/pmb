<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller {
    public function logout() {
        Auth::logout();

        return redirect()->route('auth.login')->with('status', [
            'type' => 'alert-success',
            'message' => 'Logout berhasil!'
        ]);
    }
}
