<?php

namespace App;

use Midtrans\Snap;
use Illuminate\Support\Str;

class createPaymentDTO {
    public function __construct(
        public string $order_id,
        public int $gross_amount,
        public string $first_name,
        public string $email,
        public string $phone,
        public string $address,
    ) {}
}

trait CreatePaymentTrait
{
    public function createPayment(createPaymentDTO $paymentData) {
        $params = array(
            "transaction_details" => array(
                "order_id" => $paymentData->order_id,
                "gross_amount" => $paymentData->gross_amount,
            ),
            "customer_details" => array(
                "first_name" => $paymentData->first_name,
                "email" => $paymentData->email,
                "phone" => $paymentData->phone,
                "billing_address" => array(
                    "address" => $paymentData->address,
                ),
            ),
            "item_details" => array(
                array(
                    "id" => Str::uuid(),
                    "price" => $paymentData->gross_amount,
                    "name" => "Biaya Pendaftaran",
                    "quantity" => 1,
                ),
            ),
        );
        
        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }
}