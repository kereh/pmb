<?php

namespace App\Livewire\CalonMahasiswa\Components;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Reactive;

class FormDokumen extends Component {
    use WithFileUploads;

    #[Validate('nullable')]
    #[Validate('max:1024', message: 'Ukuran file maksimal 1MB')]
    #[Validate('mimes:pdf', message: 'File harus dalam bentuk PDF')]
    public $uploadIjazah;

    #[Validate('nullable')]
    #[Validate('max:1024', message: 'Ukuran file maksimal 1MB')]
    #[Validate('mimes:pdf', message: 'File harus dalam bentuk PDF')]
    public $uploadKip;

    #[Validate('required', message: 'KTP/Akte Kelahiran Tidak Boleh Kosong')]
    #[Validate('max:1024', message: 'Ukuran file maksimal 1MB')]
    #[Validate('mimes:pdf', message: 'File harus dalam bentuk PDF')]
    public $uploadKtp;

    #[Validate('required', message: 'Kartu Keluarga Tidak Boleh Kosong')]
    #[Validate('max:1024', message: 'Ukuran file maksimal 1MB')]
    #[Validate('mimes:pdf', message: 'File harus dalam bentuk PDF')]
    public $uploadKk;

    #[Reactive]
    public $uploadedData;
    
    public $uploadedIjazah;
    public $uploadedKip;
    public $uploadedKtp;
    public $uploadedKk;
    public $user;
    

    public function mount($user, $uploadedData, $uploadedKip, $uploadedIjazah, $uploadedKtp, $uploadedKk) {
        $this->user = $user;
        $this->uploadedData = $uploadedData;
        $this->uploadedIjazah = $uploadedIjazah;
        $this->uploadedKip = $uploadedKip;
        $this->uploadedKip = $uploadedKtp;
        $this->uploadedKip = $uploadedKk;
    }

    public function saveIjazah() {
        if (!isset($this->uploadIjazah)) {
            return;
        }

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
        if (!isset($this->uploadKip)) {
            return;
        }

        $this->validateOnly('uploadKip');

        $this->uploadKip->storePubliclyAs('kip', $this->user->id . '.pdf', 'public');
        $this->uploadedKip = Storage::disk('public')->url('kip/'. $this->user->id . '.pdf');

        session()->flash('statusDokumen', [
            'type' => 'alert-success',
            'message' => 'KIP Berhasil Diupload'
        ]);

        $this->dispatch('kip', val: $this->uploadedKip);
    }

    public function saveKtp() {
        $this->validateOnly('uploadKtp');

        if (isset($this->uploadKtp)) {
            $this->uploadKtp->storePubliclyAs('ktp', $this->user->id . '.pdf', 'public');
            $this->uploadedKtp = Storage::disk('public')->url('ktp/'. $this->user->id . '.pdf');

            session()->flash('statusDokumen', [
                'type' => 'alert-success',
                'message' => 'KTP Berhasil Diupload'
            ]);
        }


        $this->dispatch('ktp', val: $this->uploadedKtp);
    }

    public function saveKk() {
        $this->validateOnly('uploadKk');

        $this->uploadKk->storePubliclyAs('kk', $this->user->id . '.pdf', 'public');
        $this->uploadedKk = Storage::disk('public')->url('kk/'. $this->user->id . '.pdf');

        session()->flash('statusDokumen', [
            'type' => 'alert-success',
            'message' => 'Kartu Keluarga Berhasil Diupload'
        ]);

        $this->dispatch('kk', val: $this->uploadedKk);
    }
}
