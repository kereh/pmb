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
        return auth()->user()->load(['data', 'payment', 'seleksi']);
    }
}