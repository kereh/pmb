<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AuthLupaPassword extends Component {
    #[Layout('components.layouts.layout-auth')]
    public $title = 'Lupa Password';

    #[Validate('required', message: 'Email tidak boleh kosong!')]
    #[Validate('email:dns', message: 'Email tidak valid!')]
    public $email;

    public function send() {
        $validated = $this->validate();
        $status = Password::sendResetLink($validated);
 
        if ($status === Password::ResetLinkSent) {
            session()->flash('status', [
                'type' => 'alert-success',
                'message' => 'Reset Password Link Berhasil Dikirim Cek Email ' . $this->email,
            ]);
        } else {
            session()->flash('status', [
                'type' => 'alert-danger',
                'message' => 'Reset Password Link Gagal Dikirim',
            ]);
        }

        $this->reset();
    }
}
