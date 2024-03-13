<?php

namespace App\PurchaseHandler;

interface PaymentInterface
{
    public function pay(float $price): void;
}