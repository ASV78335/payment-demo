<?php

namespace App\PurchaseHandler;

use App\PriceCalculator\BusinessLogicException;
use App\ThirdPartyProcessors\PaypalPaymentProcessor;
use Exception;

class PaypalPaymentHandler implements PaymentInterface
{
    public function pay(float $price): void
    {
        $processor = new PaypalPaymentProcessor();
        $sum = round($price * 100);

        try {
            $processor->pay($sum);
        } catch (Exception $e) {
            throw new BusinessLogicException($e->getMessage());
        }
    }
}