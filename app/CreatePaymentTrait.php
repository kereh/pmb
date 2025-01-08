<?php

namespace App;

use Midtrans\Snap;
use App\DTO\createPaymentDTO;

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
                    "id" => $paymentData->gross_amount_id,
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