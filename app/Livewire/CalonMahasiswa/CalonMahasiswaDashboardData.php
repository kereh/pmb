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
    public $title = 'Data';

    public $uploadedPasFoto;
    public $uploadedIjazah;
    public $uploadedKip;
    public $uploadedData = false;

    public function mount() {
        $checkUploadedPasFoto = Storage::exists('pas_foto/' . $this->user->id . '.png');
        $checkUploadedIjazah = Storage::exists('ijazah/' . $this->user->id . '.pdf');
        $checkUploadedKip = Storage::exists('kip/' . $this->user->id . '.pdf');
        $checkUploadedData = $this->user()->data()->first();

        $this->uploadedPasFoto = $checkUploadedPasFoto
            ? Storage::url('pas_foto/' . $this->user->id . '.png')
            : null;

        $this->uploadedIjazah = $checkUploadedIjazah
            ? Storage::url('ijazah/' . $this->user->id . '.pdf')
            : null;

        $this->uploadedKip = $checkUploadedKip
            ? Storage::url('kip/' . $this->user->id . '.pdf')
            : null;

        $this->uploadedData = $checkUploadedData
            ? true
            : false;
    }

    #[Computed()]
    public function user() {
        return Auth::user();
    }

    #[Computed()]
    public function program_studi() {
        return ProgramStudi::all();
    }

    #[Computed()]
    public function biaya_pendaftaran() {
        return BiayaPendaftaran::first();
    }

    #[On('pas_foto')]
    public function pasFotoListener($val) {
        $this->uploadedPasFoto = $val;
    }

    #[On('ijazah')]
    public function ijazahListener($val) {
        $this->uploadedIjazah = $val;
    }

    #[On('kip')]
    public function kipListener($val) {
        $this->uploadedKip = $val;
    }

    #[On('data-submited')]
    public function submitListener() {
        $this->uploadedData = !$this->uploadedData;
    }
}
