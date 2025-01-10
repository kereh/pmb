<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AuthRegistrasi extends Component {
    #[Layout('components.layouts.layout-auth')]

    #[Validate('required', message: 'Nama harus diisi!')]
    #[Validate('max:100', message: 'Nama tidak boleh lebih dari 100 karakter')]
    #[Validate('min:3', message: 'Nama minimal 3 karakter')]
    #[Validate('string', message: 'Nama hanya boleh berisi huruf')]
    public $nama;

    #[Validate('required', message: 'Email harus diisi!')]
    #[Validate('email:rfc,dns', message: 'Email tidak valid!')]
    #[Validate('unique:users,email', message: 'Email sudah digunakan!')]
    public $email;

    #[Validate('required', message: 'Username harus diisi!')]
    #[Validate('unique:users,username', message: 'Username sudah digunakan!')]
    #[Validate('min:4', message: 'Username minimal 4 karakter!')]
    #[Validate('max:20', message: 'Username tidak boleh lebih dari 20 karakter!')]
    public $username;

    #[Validate('required', message: 'Password harus diisi!')]
    #[Validate('min:4', message: 'Password minimal 4 karakter!')]
    #[Validate('confirmed', message: 'Password yang dimasukan tidak sama!')]
    public $password;

    public $password_confirmation;
    public $title = 'Registrasi';

    #[Computed]
    public function create(array $data) {
        return User::create($data);
    }

    public function store() {
        $this->validate();

        $data = [
            'nama' => $this->nama,
            'email' => $this->email,
            'username' => $this->username,
            'password' => $this->password,
            'role_id' => 2,
            'seleksi_id' => 1,
        ];

        $this->create($data);

        session()->flash('status', [
            'type' => 'alert-success',
            'message' => 'Registrasi berhasil',
        ]);

        return $this->redirect('login');
    }
}
