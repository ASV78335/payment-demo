<?php

namespace App;

class Config
{
    public const COUNTRY_TAXES = [
        'DE' => 19,
        'IT' => 22,
        'FR' => 20,
        'GR' => 24
    ];

    public const TAX_NUMBER_MASK = "/(^DE[0-9]{9}$)|(^IT[0-9]{11}$)|(^GR[0-9]{9}$)|(^FR[A-Z]{2}[0-9]{9}$)/";

    public const COUPON_CODE_MASK = "/^\w{8}$/";

    const PAYMENT_PROCESSORS = [
        'paypal',
        'stripe'
    ];

    public const PAYMENT_HANDLERS = [
        'paypal' => 'App\PurchaseHandler\PaypalPaymentHandler',
        'stripe' => 'App\PurchaseHandler\StripePaymentHandler'
    ];
}