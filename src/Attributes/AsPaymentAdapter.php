<?php

namespace App\Attributes;

use Attribute;

#[Attribute]
class AsPaymentAdapter
{
    public function __construct(string $name)
    {

    }
}
