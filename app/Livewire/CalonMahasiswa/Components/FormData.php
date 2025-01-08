<?php

namespace App\Livewire\CalonMahasiswa\Components;

use Livewire\Component;
use Livewire\Attributes\Validate;

use App\Models\Data;
use App\Livewire\CalonMahasiswa\CalonMahasiswaDashboardData;

class FormData extends Component {
    #[Validate('required', message: 'NIK Tidak Boleh Kosong')]
    #[Validate('numeric', message: 'NIK Harus Berisi Angka')]
    #[Validate('digits:16', message: 'NIK harus terdiri dari 16 digit')]
    #[Validate('unique:data,nik', message: 'NIK sudah terpakai')]
    public $nik;

    #[Validate('required', message: 'NISN Tidak Boleh Kosong')]
    #[Validate('numeric', message: 'NISN Harus Berisi Angka')]
    #[Validate('digits:10', message: 'NISN harus terdiri dari 10 digit')]
    #[Validate('unique:data,nisn', message: 'NISN sudah terpakai')]
    public $nisn;

    #[Validate('required', message: 'Nama Ibu Kandung Tidak Boleh Kosong')]
    #[Validate('string', message: 'Nama Hanya Berisi Huruf')]
    #[Validate('max:100', message: 'Nama Tidak Boleh Lebih Dari 100 karakter')]
    public $nama_ibu_kandung;

    #[Validate('required', message: 'Tanggal Lahir Tidak Boleh Kosong')]
    public $tanggal_lahir;

    #[Validate('required', message: 'Tempat Lahir Tidak Boleh Kosong')]
    public $tempat_lahir;

    #[Validate('required', message: 'Alamat Lahir Tidak Boleh Kosong')]
    public $alamat;

    #[Validate('required', message: 'Nomor Hp Tidak Boleh Kosong')]
    #[Validate('numeric', message: 'Nomor Hp Harus Berisi Angka')]
    public $nomor_hp;

    #[Validate('required', message: 'Jenis Kelamin Tidak Boleh Kosong')]
    public $jenis_kelamin;

    #[Validate('required', message: 'Pendidikan Terakhir Tidak Boleh Kosong')]
    public $pendidikan_terakhir;

    #[Validate('required', message: 'Agama Tidak Boleh Kosong')]
    public $agama;

    #[Validate('required', message: 'Kewarganegaraan Tidak Boleh Kosong')]
    public $kewarganegaraan;

    #[Validate('required', message: 'Program Studi Tidak Boleh Kosong')]
    public $program_studi_id;

    #[Validate('required', message: 'Nama Tidak Boleh Kosong')]
    public $nama;

    public $user;
    public $programStudi;
    public $biayaPendaftaran;
    public $uploadedPasFoto;
    public $uploadedIjazah;
    public $uploadedKip;

    public function mount($user, $uploadedPasFoto, $uploadedIjazah, $uploadedKip) {
        $this->user = $user;
        $this->uploadedPasFoto = $uploadedPasFoto;
        $this->uploadedIjazah = $uploadedIjazah;
        $this->uploadedKip = $uploadedKip;
        $this->nama = $this->user->nama;
    }

    public function store() {
        $validated = $this->validate();
        $validated['pas_foto'] = $this->uploadedPasFoto;
        $validated['ijazah_atau_skl'] = $this->uploadedIjazah;
        $validated['kip'] = $this->uploadedKip;

        $data = Data::create($validated);

        $this->user->data_id = $data->id;
        $this->user->save();

        session()->flash('status', [
            'type' => 'alert-success', 
            'message' => 'Data Berhasil Disubmit!'
            ]
        );

        $this->dispatch('data-submited')->to(CalonMahasiswaDashboardData::class);
    }

    public function changeProgramStudiSelected($value) {
        $this->program_studi_id = $value;
    }
    
    public function changeJenisKelaminSelected($value) {
        $this->jenis_kelamin = $value;
    }
    
    public function changePendidikanTerakhirSelected($value) {
        $this->pendidikan_terakhir = $value;
    }
    
    public function changeKewargaNegaraanSelected($value) {
        $this->kewarganegaraan = $value;
    }
    
    public function changeAgamaSelected($value) {
        $this->agama = $value;
    }
}
