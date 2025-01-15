<?php

namespace App\Livewire\CalonMahasiswa;

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
        $user = $this->user;
        $checkUploadedPasFoto = Storage::disk('public')->exists('pas_foto/' . $user->id . '.png');
        $checkUploadedIjazah = Storage::disk('public')->exists('ijazah/' . $user->id . '.pdf');
        $checkUploadedKip = Storage::disk('public')->exists('kip/' . $user->id . '.pdf');
        $checkUploadedData = $user->data;
        
        $this->uploadedPasFoto = $checkUploadedPasFoto
            ? Storage::disk('public')->url('pas_foto/' . $user->id . '.png')
            : null;
        
        $this->uploadedIjazah = $checkUploadedIjazah
            ? Storage::disk('public')->url('ijazah/' . $user->id . '.pdf')
            : null;
        
        $this->uploadedKip = $checkUploadedKip
            ? Storage::disk('public')->url('kip/' . $user->id . '.pdf')
            : null;
        
        $this->uploadedData = $checkUploadedData
            ? true
            : false;
    }

    #[Computed()]
    public function user() {
        return auth()->user()->load('data');
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
