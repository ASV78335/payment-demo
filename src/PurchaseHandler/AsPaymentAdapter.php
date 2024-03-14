<?php

namespace App\PurchaseHandler;

use Attribute;

#[Attribute]
class AsPaymentAdapter
{
    public function __construct(string $name)
    {

    }
}