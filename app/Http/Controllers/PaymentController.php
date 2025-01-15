<?php

namespace App\Http\Controllers;

use App\Models\Payments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use Midtrans\Transaction;

class PaymentController extends Controller {
    public function verify(Request $request, $id) {

        $payment = Payments::where('order_id', $id)->first();

        if (!Gate::allows('verify-payment', $payment)) {
            abort(403);
        }

        try {
            /** @var stdClass */
            $payment = Transaction::status($id);
            $key = config('midtrans.serverKey');

            $order_id = $id;
            $status_code = $payment->status_code;
            $gross_amount = $payment->gross_amount;
            $payment_type = $payment->payment_type == 'echannel' ? 'Mandiri Bill' : 'Bank Transfer';
            $bank = $payment_type == 'Mandiri Bill' ? 'Bank Mandiri' : $payment->va_numbers[0]->bank;
            $waktu_pembayaran = $payment->transaction_time;
            
            $sign = hash('sha512', $order_id . $status_code . $gross_amount . $key);
            
            if ($payment->signature_key == $sign) {
                Auth::user()->payment()->where('order_id', $id)->update([
                    'status' => true,
                    'jenis_pembayaran' => $payment_type,
                    'bank' => $bank,
                    'waktu_pembayaran' => $waktu_pembayaran,
                ]);

                return redirect()->route('calon_mahasiswa.pembayaran');
            }
        } catch (\Throwable $th) {
            return redirect()->route('calon_mahasiswa.pembayaran')->with('statusPayment', [
                'type' => 'alert-danger',
                'icon' => 'bi-x-circle',
                'message' => 'Transaksi Tidak Tersedia!'
            ]);
        }
    }

    public function check($id) {
        dd(Transaction::status($id));
    }
}
