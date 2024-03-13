<?php

namespace App;

class Config
{
    const TAX_NUMBER_MASK = "/(^DE[0-9]{9}$)|(^IT[0-9]{11}$)|(^GR[0-9]{9}$)|(^FR[A-Z]{2}[0-9]{9}$)/";
    const COUPON_CODE_MASK = "/^(P|D)[0-9]+$/";
}