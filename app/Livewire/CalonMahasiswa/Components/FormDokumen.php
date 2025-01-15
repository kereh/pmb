<?php

namespace App\Livewire\CalonMahasiswa\Components;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Reactive;

class FormDokumen extends Component {

    use WithFileUploads;

    #[Validate('required', message: 'Ijazah atau SKL tidak boleh kosong!')]
    #[Validate('max:1024', message: 'Ukuran file maksimal 1MB')]
    #[Validate('mimes:pdf', message: 'File harus dalam bentuk PDF')]
    public $uploadIjazah;

    #[Validate('nullable')]
    #[Validate('max:1024', message: 'Ukuran file maksimal 1MB')]
    #[Validate('mimes:pdf', message: 'File harus dalam bentuk PDF')]
    public $uploadKip;

    #[Reactive]
    public $uploadedData;
    
    public $uploadedIjazah;
    public $uploadedKip;
    public $user;
    

    public function mount($user, $uploadedData, $uploadedKip, $uploadedIjazah) {
        $this->user = $user;
        $this->uploadedData = $uploadedData;
        $this->uploadedIjazah = $uploadedIjazah;
        $this->uploadedKip = $uploadedKip;
    }

    public function saveIjazah() {
        $this->validateOnly('uploadIjazah');

        $this->uploadIjazah->storePubliclyAs('ijazah', $this->user->id . '.pdf', 'public');

        $this->uploadedIjazah = Storage::disk('public')->url('ijazah/'. $this->user->id . '.pdf');

        session()->flash('statusDokumen', [
            'type' => 'alert-success',
            'message' => 'Ijazah Berhasil Diupload'
        ]);

        $this->dispatch('ijazah', val: $this->uploadedIjazah);
    }

    public function saveKip() {
        if (isset($this->uploadKip)) {
            $this->validateOnly('uploadKip');
    
            $this->uploadKip->storePubliclyAs('kip', $this->user->id . '.pdf', 'public');
    
            $this->uploadedKip = Storage::disk('public')->url('kip/'. $this->user->id . '.pdf');
    
            session()->flash('statusDokumen', [
                'type' => 'alert-success',
                'message' => 'KIP Berhasil Diupload'
            ]);

            $this->dispatch('kip', val: $this->uploadedKip);
        }

        return;
    }
}
