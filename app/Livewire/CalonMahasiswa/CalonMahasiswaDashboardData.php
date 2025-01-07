<?php

namespace App\Livewire\CalonMahasiswa;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class CalonMahasiswaDashboardData extends Component {
    #[Layout('components.layouts.layout-calon-mahasiswa')]
    public $title = 'Data Calon Mahasiswa';

    public $uploadedPasFoto;
    public $uploadedIjazah;
    public $uploadedKip;

    public function mount() {
        $checkUploadedPasFoto = Storage::exists('pas_foto/' . $this->user->id . '.png');
        $checkUploadedIjazah = Storage::exists('ijazah/' . $this->user->id . '.pdf');
        $checkUploadedKip = Storage::exists('kip/' . $this->user->id . '.pdf');
        
        $this->uploadedPasFoto = $checkUploadedPasFoto
            ? Storage::url('pas_foto/' . $this->user->id . '.png')
            : null;

        $this->uploadedIjazah = $checkUploadedIjazah
            ? Storage::url('ijazah/' . $this->user->id . '.pdf')
            : null;

        $this->uploadedKip = $checkUploadedKip
            ? Storage::url('kip/' . $this->user->id . '.pdf')
            : null;
    }

    #[Computed()]
    public function user() {
        return Auth::user()->load(['roles','data','payment'])->first();
    }

    #[On('pasFoto')]
    public function updatePasFoto() {
        $this->uploadedPasFoto = Storage::url('pas_foto/' . $this->user->id . '.png');
    }

    #[On('ijazah')]
    public function updateIjazah() {
        $this->uploadedIjazah = Storage::url('ijazah/' . $this->user->id . '.pdf');
    }

    #[On('kip')]
    public function updateKip() {
        $this->uploadedKip = Storage::url('kip/' . $this->user->id . '.pdf');
    }
}
