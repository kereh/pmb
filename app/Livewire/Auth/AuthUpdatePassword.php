<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class AuthUpdatePassword extends Component  {
    #[Layout('components.layouts.layout-auth')]
    public $title = 'Update Password';

    public function mount($token) {
        dd($token);
    }
}
