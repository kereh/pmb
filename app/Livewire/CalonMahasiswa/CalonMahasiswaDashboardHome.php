<?php

namespace App\Livewire\CalonMahasiswa;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CalonMahasiswaDashboardHome extends Component {
    #[Layout('components.layouts.layout-calon-mahasiswa')]
    public $title = 'Dashboard Calon Mahasiswa';

    #[Computed()]
    public function user() {
        return Auth::user()->load(['data', 'payment']);
    }
}