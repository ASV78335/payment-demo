<?php

namespace App\PurchaseHandler\PaymentAdapters;

interface PaymentInterface
{
    public function pay(float $price): bool;
}
