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
    public $uploadedKtp;
    public $uploadedKk;
    public $uploadedData = false;

    public function mount() {
        $user = $this->user;

        $this->uploadedPasFoto = $this->getUploadedFileUrl('pas_foto', 'png', $user->id);
        $this->uploadedIjazah = $this->getUploadedFileUrl('ijazah', 'pdf', $user->id);
        $this->uploadedKip = $this->getUploadedFileUrl('kip', 'pdf', $user->id);
        $this->uploadedKtp = $this->getUploadedFileUrl('ktp', 'pdf', $user->id);
        $this->uploadedKk = $this->getUploadedFileUrl('kk', 'pdf', $user->id);
        $this->uploadedData = (bool) $user->data;
    }

    private function getUploadedFileUrl(string $folder, string $extension, string $userId): ?string {
        $path = "{$folder}/{$userId}.{$extension}";
        return Storage::disk('public')->exists($path)
            ? Storage::disk('public')->url($path)
            : null;
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

    #[On('ktp')]
    public function ktpListener($val) {
        $this->uploadedKtp = $val;
    }

    #[On('kk')]
    public function kkListener($val) {
        $this->uploadedKk = $val;
    }

    #[On('data-submited')]
    public function submitListener() {
        $this->uploadedData = !$this->uploadedData;
    }
}
