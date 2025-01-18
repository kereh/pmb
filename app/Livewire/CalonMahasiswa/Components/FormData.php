<?php

namespace App\Livewire\CalonMahasiswa\Components;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Reactive;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\CreatePaymentTrait;
use App\createPaymentDTO;

class FormData extends Component {
    use CreatePaymentTrait;

    #[Validate('required', message: 'Tanggal Lahir Tidak Boleh Kosong')]
    public $jurusan;

    #[Validate('required', message: 'Tanggal Lahir Tidak Boleh Kosong')]
    public $tanggal_lahir;

    #[Validate('required', message: 'Nomor Telepon Tidak Boleh Kosong')]
    #[Validate('numeric', message: 'Nomor Telepon Harus Berisi Angka')]
    #[Validate('digits_between:10,13', message: 'Nomor Telepon tidak valid')]
    #[Validate('unique:data,no_telp_pribadi', message: 'Nomor Telepon Tidak Boleh Lebih Dari 13 Digit')]
    public $no_telp_pribadi;

    #[Validate('required', message: 'Nomor Telepon Orang Tua Tidak Boleh Kosong')]
    #[Validate('numeric', message: 'Nomor Telepon Orang Tua Harus Berisi Angka')]
    #[Validate('digits_between:10,13', message: 'Nomor Telepon Orang Tua tidak valid')]
    #[Validate('unique:data,no_telp_orang_tua', message: 'Nomor Telepon Orang Tua Tidak Boleh Lebih Dari 13 Digit')]
    public $no_telp_orang_tua;

    #[Validate('required', message: 'Asal Daerah Propinsi Tidak Boleh Kosong')]
    public $asal_daerah_provinsi;

    #[Validate('required', message: 'Asal Daerah Kabupaten/Kota Tidak Boleh Kosong')]
    public $asal_daerah_kabupaten_kota;

    #[Validate('required', message: 'Asal Sekolah Tidak Boleh Kosong')]
    public $asal_sekolah;

    #[Validate('nullable')]
    public $rekomendasi;

    #[Reactive]
    public $uploadedPasFoto;
    #[Reactive]
    public $uploadedIjazah;
    #[Reactive]
    public $uploadedKip;
    #[Reactive]
    public $uploadedKtp;
    #[Reactive]
    public $uploadedKk;
    
    public $user;
    public $programStudi;
    public $biayaPendaftaran;

    public function mount($user, $uploadedPasFoto, $uploadedIjazah, $uploadedKip, $uploadedKtp, $uploadedKk) {
        $this->user = $user;
        $this->uploadedPasFoto = $uploadedPasFoto;
        $this->uploadedIjazah = $uploadedIjazah;
        $this->uploadedKip = $uploadedKip;
        $this->uploadedKtp = $uploadedKtp;
        $this->uploadedKk = $uploadedKk;
        $this->nama = $this->user->nama;
    }

    public function store() {
        $validated = $this->validate();
        $validated['pas_foto'] = $this->uploadedPasFoto;
        $validated['ijazah'] = $this->uploadedIjazah;
        $validated['kip'] = $this->uploadedKip;
        $validated['ktp'] = $this->uploadedKtp;
        $validated['kk'] = $this->uploadedKk;
        
        dd($validated);

        DB::transaction(function () use ($validated) {

            $this->user->data()->create($validated);

            $orderId = Str::uuid();
    
            $paymentData = new createPaymentDTO(
                order_id: $orderId,
                gross_amount: (int)$this->biayaPendaftaran->biaya,
                first_name: $this->user->nama,
                email: $this->user->email,
                phone: $this->user->data->nomor_hp,
                address: $this->user->data->alamat,
            );
    
            $snapToken = $this->createPayment($paymentData);
            $this->user->payments()->updateOrCreate(
                ['user_id' => $this->user->id],
                [
                    'order_id' => $orderId,
                    'snap_token' => $snapToken,
                    'price' => $this->biayaPendaftaran->biaya,
                ]
            );
    
            session()->flash('status', [
                'type' => 'alert-success', 
                'message' => 'Data Berhasil Disubmit!'
                ]
            );
        });

        $this->dispatch('submited');
    }

    public function payment() {}

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
