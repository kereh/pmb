<?php

namespace App\Livewire\CalonMahasiswa;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

use App\Models\BiayaPendaftaran;
use App\Models\ProgramStudi;

class CalonMahasiswaDashboardData extends Component {
    #[Layout('components.layouts.layout-calon-mahasiswa')]
    public $title = 'Data Calon Mahasiswa';

    public $uploadedPasFoto;
    public $uploadedIjazah;
    public $uploadedKip;
    public $uploadedData;

    public function mount() {
        $checkUploadedPasFoto = Storage::exists('pas_foto/' . $this->fetch['user']->id . '.png');
        $checkUploadedIjazah = Storage::exists('ijazah/' . $this->fetch['user']->id . '.pdf');
        $checkUploadedKip = Storage::exists('kip/' . $this->fetch['user']->id . '.pdf');
        $checkUploadedData = Auth::user()->data;
        
        $this->uploadedPasFoto = $checkUploadedPasFoto
            ? Storage::url('pas_foto/' . $this->fetch['user']->id . '.png')
            : null;

        $this->uploadedIjazah = $checkUploadedIjazah
            ? Storage::url('ijazah/' . $this->fetch['user']->id . '.pdf')
            : null;

        $this->uploadedKip = $checkUploadedKip
            ? Storage::url('kip/' . $this->fetch['user']->id . '.pdf')
            : null;

        $this->uploadedData = $checkUploadedData
            ? true
            : false;
    }

    #[Computed()]
    public function fetch() {
        return [
            'user' => Auth::user()->load(['roles','data','payment'])->first(),
            'program_studi' => ProgramStudi::all(),
            'biaya_pendaftaran' => BiayaPendaftaran::first(),
        ];
    }

    #[On('pasFoto')]
    public function updatePasFoto() {
        $this->uploadedPasFoto = Storage::url('pas_foto/' . $this->fetch['user']->id . '.png');
    }

    #[On('ijazah')]
    public function updateIjazah() {
        $this->uploadedIjazah = Storage::url('ijazah/' . $this->fetch['user']->id . '.pdf');
    }

    #[On('kip')]
    public function updateKip() {
        $this->uploadedKip = Storage::url('kip/' . $this->fetch['user']->id . '.pdf');
    }

    #[On('submited')]
    public function updateSubmited() {
        $this->uploadedData = true;
    }
}
