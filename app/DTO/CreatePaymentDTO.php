<?php

namespace App\DTO;

class createPaymentDTO
{
    public $order_id;
    public $gross_amount;
    public $gross_amount_id;
    public $first_name;
    public $email;
    public $phone;
    public $address;

    public function __construct($order_id, $gross_amount, $first_name, $email, $phone, $address, $gross_amount_id)
    {
        $this->order_id = $order_id;
        $this->gross_amount = $gross_amount;
        $this->first_name = $first_name;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->gross_amount_id = $gross_amount_id;
    }
}