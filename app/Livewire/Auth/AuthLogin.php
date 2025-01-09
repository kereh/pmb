<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AuthLogin extends Component {
    #[Layout('components.layouts.layout-auth')]

    #[Validate('required', message: 'Username harus diisi!')]
    public $username;
    
    #[Validate('required', message: 'Password harus diisi!')]
    public $password;

    public $remember;
    public $title = 'Login';

    public function login() {
        $validated = $this->validate();

        if (Auth::attempt($validated, $this->remember)) {

            if (Auth::user()->roles->role == 'admin') {
                return $this->redirect('/admin');
            }           

            return $this->redirectRoute('calon_mahasiswa');
        }
        
        session()->flash('status', [
            'type' => 'alert-danger',
            'message' => 'Login Gagal! Periksa kembali username dan password'
        ]);        
    }
}
