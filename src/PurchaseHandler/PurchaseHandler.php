<?php

namespace App\PurchaseHandler;

use App\Config;
use App\Model\PurchaseRequest;

class PurchaseHandler
{
    public function purchase(PurchaseRequest $request, float $sum): void
    {
        $processorName = Config::PAYMENT_HANDLERS[$request->getPaymentProcessor()];

        /** @var PaymentInterface $processor */
        $processor = new $processorName();

        $processor->pay($sum);
    }
}