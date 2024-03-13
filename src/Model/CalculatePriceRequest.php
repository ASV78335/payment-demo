<?php

namespace App\Model;

use App\Config;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\Regex;

class CalculatePriceRequest
{
    #[Positive]
    private ?int $product;

    #[Regex (Config::TAX_NUMBER_MASK)]
    private ?string $taxNumber;

    #[Regex (Config::COUPON_CODE_MASK)]
    private ?string $couponCode;

    public function getProduct(): ?int
    {
        return $this->product;
    }

    public function setProduct(?int $product): void
    {
        $this->product = $product;
    }

    public function getTaxNumber(): ?string
    {
        return $this->taxNumber;
    }

    public function setTaxNumber(?string $taxNumber): void
    {
        $this->taxNumber = $taxNumber;
    }

    public function getCouponCode(): ?string
    {
        return $this->couponCode;
    }

    public function setCouponCode(?string $couponCode): void
    {
        $this->couponCode = $couponCode;
    }

}