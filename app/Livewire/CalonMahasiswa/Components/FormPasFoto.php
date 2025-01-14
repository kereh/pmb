<?php

namespace App\Livewire\CalonMahasiswa\Components;

use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormPasFoto extends Component {

    use WithFileUploads;

    #[Validate('required', message: 'Pas Foto Harus Diisi!')]
    #[Validate('image', message: 'Pas Foto Harus Berupa Gambar!')]
    #[Validate('max:1024', message: 'Ukuran Pas Foto Tidak Boleh Lebih Dari 1 MB!')]
    #[Validate('dimensions:ratio=3/4', message: 'Rasio Pas Foto Harus Berukuran 3x4!')]
    #[Validate('mimes:png', message: 'Pas Foto Harus Berformat PNG!')]
    public $pasFotoUpload;
    public $pasFotoPreview;
    public $uploadedPasFoto;
    public $user;

    public function mount($user, $uploadedPasFoto) {
        $this->user = $user;
        $this->uploadedPasFoto = $uploadedPasFoto;
    }

    public function save() {
        $this->validate();
        
        $this->pasFotoUpload->storeAs('pas_foto', $this->user->id . '.png', 'public');

        $this->uploadedPasFoto = Storage::disk('public')->url('pas_foto/' . $this->user->id . '.png');
        $this->pasFotoPreview = $this->pasFotoUpload->temporaryUrl();

        session()->flash('statusPasFoto', [
            'type' => 'alert-success', 
            'message' => 'Pas Foto Berhasil Diupload!'
        ]);

        $this->dispatch('pas_foto', val: $this->uploadedPasFoto);
    }
}
