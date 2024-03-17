<?php

namespace App\PurchaseHandler\PaymentAdapters;

use App\Attributes\AsPaymentAdapter;
use App\Exceptions\BusinessLogicException;
use App\ThirdPartyProcessors\StripePaymentProcessor;

#[AsPaymentAdapter ('stripe')]
class StripePaymentAdapter implements PaymentInterface
{
    public function pay(float $price): bool
    {
        $processor = new StripePaymentProcessor();
        $result = $processor->processPayment($price);

        if (!$result) throw new BusinessLogicException('Payment error');
        return true;
    }
}
