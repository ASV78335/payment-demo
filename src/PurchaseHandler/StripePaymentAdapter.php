<?php

namespace App\PurchaseHandler;

use App\PriceCalculator\BusinessLogicException;
use App\ThirdPartyProcessors\StripePaymentProcessor;

#[AsPaymentAdapter ('stripe')]
class StripePaymentAdapter implements PaymentInterface
{
    public function pay(float $price): void
    {
        $processor = new StripePaymentProcessor();
        $result = $processor->processPayment($price);

        if (!$result) throw new BusinessLogicException('Payment error');
    }
}