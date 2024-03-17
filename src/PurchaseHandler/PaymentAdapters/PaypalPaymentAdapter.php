<?php

namespace App\PurchaseHandler\PaymentAdapters;

use App\Attributes\AsPaymentAdapter;
use App\Exceptions\BusinessLogicException;
use App\ThirdPartyProcessors\PaypalPaymentProcessor;
use Exception;

#[AsPaymentAdapter ('paypal')]
class PaypalPaymentAdapter implements PaymentInterface
{
    public function pay(float $price): bool
    {
        $processor = new PaypalPaymentProcessor();
        $sum = round($price * 100);

        try {
            $processor->pay($sum);
        } catch (Exception $e) {
            throw new BusinessLogicException($e->getMessage());
        }
        return true;
    }
}
