<?php

namespace App\Livewire\CalonMahasiswa;

use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CalonMahasiswaKartu extends Component {
    #[Layout('components.layouts.layout-calon-mahasiswa')]

    public $title = "Cetak Kartu Ujian";

    #[Computed()]
    public function status() {
        return Auth::user()->payments->status;
    }
}
