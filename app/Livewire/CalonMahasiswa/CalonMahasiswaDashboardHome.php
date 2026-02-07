<?php

namespace App\Livewire\CalonMahasiswa;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CalonMahasiswaDashboardHome extends Component {
    #[Layout('components.layouts.layout-calon-mahasiswa')]
    public $title = 'Dashboard';

    #[Computed()]
    public function user() {
        /** @var Illuminate\Support\Facades\Auth $user */
        $user = Auth::user();
        return $user->load(['data', 'payments', 'seleksi']);
    }
}
