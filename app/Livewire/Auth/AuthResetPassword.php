<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Layout;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class AuthResetPassword extends Component  {
    #[Layout('components.layouts.layout-auth')]
    public $title = 'Reset Password';

    #[Validate('required')]
    public $token;

    #[Validate('required', message: 'Email tidak boleh kosong!')]
    #[Validate('email:dns', message: 'Email tidak valid!')]
    public $email;

    #[Validate('required', message: 'Password harus diisi!')]
    #[Validate('min:4', message: 'Password minimal 4 karakter!')]
    #[Validate('confirmed', message: 'Password yang dimasukan tidak sama!')]
    public $password;

    public $password_confirmation;

    public function mount($token) {
        $this->token = $token;
    }

    public function update() {
        $this->validate();

        $status = Password::reset(
            $this->only('email', 'password', 'password_confirmation', 'token'),

            function ($user, $password) {
                $user->forceFill(['password' => Hash::make($password)])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            session()->flash('status', [
                'type' => 'alert-success',
                'message' => 'Password Berhasil Diperbarui!',
            ]);

            return $this->redirectRoute('auth.login');

        } else {
            session()->flash('status', [
                'type' => 'alert-danger',
                'message' => 'Password Gagal Diperbarui',
            ]);

            return $this->redirectRoute('auth.login');
        }

        $this->reset();
    }
}
