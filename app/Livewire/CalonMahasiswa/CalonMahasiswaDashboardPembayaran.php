<?php

namespace App\Livewire\CalonMahasiswa;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

use Midtrans\Transaction;

use App\Models\BiayaPendaftaran;
use App\CreatePaymentTrait;
use App\createPaymentDTO;

class CalonMahasiswaDashboardPembayaran extends Component {
    use CreatePaymentTrait;

    #[Layout('components.layouts.layout-calon-mahasiswa')]
    public $title = 'Pembayaran';

    public $isExpired;

    public function mount() {
        try {
            $response = (object)Transaction::status($this->user->payment->order_id);
            $this->isExpired = $response->transaction_status == 'expire' ? true : false;

        } catch (\Throwable $th) {
            $this->isExpired = false;
        }
    }

    public function update() {
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

        $this->user->payment()->update([
            'order_id' => $orderId,
            'snap_token' => $snapToken,
        ]);

        session()->flash('statusPayment', [
            'type' => 'alert-success', 
            'message' => 'Pembayaran berhasil diperbarui!'
            ]
        );

        return $this->redirectRoute('calon_mahasiswa.pembayaran');
    }

    #[Computed()]
    public function user() {
        return Auth::user();
    }

    #[Computed()]
    public function biaya_pendaftaran() {
        return BiayaPendaftaran::first(['biaya']);
    }
}
