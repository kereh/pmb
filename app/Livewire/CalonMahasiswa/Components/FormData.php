<?php

namespace App\Livewire\CalonMahasiswa\Components;

use Livewire\Component;
use Livewire\Attributes\Validate;

class FormData extends Component {
    #[Validate('required', message: 'NIK Tidak Boleh Kosong')]
    #[Validate('numeric', message: 'NIK Harus Berisi Angka')]
    #[Validate('digits:16', message: 'NIK tidak valid')]
    #[Validate('unique:data_mahasiswa,nik', message: 'NIK sudah terpakai')]
    public $nik;
    #[Validate('required', message: 'NISN Tidak Boleh Kosong')]
    #[Validate('numeric', message: 'NISN Harus Berisi Angka')]
    #[Validate('digits:10', message: 'NISN tidak valid')]
    #[Validate('unique:data_mahasiswa,nisn', message: 'NISN sudah terpakai')]
    public $nisn;
    #[Validate('required', message: 'Nama Ibu Kandung Tidak Boleh Kosong')]
    #[Validate('string', message: 'Nama Hanya Berisi Huruf')]
    #[Validate('max:100', message: 'Nama Tidak Boleh Lebih Dari 100 karakter')]
    public $namaIbuKandung;
    #[Validate('required', message: 'Tanggal Lahir Tidak Boleh Kosong')]
    public $tanggalLahir;
    #[Validate('required', message: 'Tempat Lahir Tidak Boleh Kosong')]
    public $tempatLahir;
    #[Validate('required', message: 'Alamat Lahir Tidak Boleh Kosong')]
    public $alamat;
    #[Validate('required', message: 'Nomor Hp Tidak Boleh Kosong')]
    #[Validate('numeric', message: 'Nomor Hp Harus Berisi Angka')]
    public $nomorHp;
    #[Validate('required', message: 'Jenis Kelamin Tidak Boleh Kosong')]
    public $jenisKelamin;
    #[Validate('required', message: 'Pendidikan Terakhir Tidak Boleh Kosong')]
    public $pendidikanTerakhir;
    #[Validate('required', message: 'Agama Tidak Boleh Kosong')]
    public $agama;
    #[Validate('required', message: 'Kewarganegaraan Tidak Boleh Kosong')]
    public $kewargaNegaraan;
    #[Validate('required', message: 'Program Studi Tidak Boleh Kosong')]
    public $programStudiId;

    public $user;
    public $uploadedPasFoto;
    public $uploadedIjazah;
    public $uploadedKip;

    public $biayaPendaftaran;
    public $programStudi;
    public $data;
    public $submited = false;

    public function mount($user, $uploadedPasFoto, $uploadedIjazah, $uploadedKip) {
        $this->user = $user;
        $this->uploadedPasFoto = $uploadedPasFoto;
        $this->uploadedIjazah = $uploadedIjazah;
        $this->uploadedKip = $uploadedKip;
    }

    public function changeProgramStudiSelected($value) {
        $this->programStudiId = $value;
    }
    
    public function changeJenisKelaminSelected($value) {
        $this->jenisKelamin = $value;
    }
    
    public function changePendidikanTerakhirSelected($value) {
        $this->pendidikanTerakhir = $value;
    }
    
    public function changeKewargaNegaraanSelected($value) {
        $this->kewargaNegaraan = $value;
    }
    
    public function changeAgamaSelected($value) {
        $this->agama = $value;
    }
}
