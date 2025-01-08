<?php

namespace App\Livewire\CalonMahasiswa;

use App\Models\BiayaPendaftaran;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CalonMahasiswaDashboardPembayaran extends Component {
    #[Layout('components.layouts.layout-calon-mahasiswa')]
    public $title = 'Pembayaran';

    #[Computed()]
    public function user() {
        return Auth::user()->load('data');
    }

    #[Computed()]
    public function biaya_pendaftaran() {
        return BiayaPendaftaran::first(['biaya']);
    }
}
