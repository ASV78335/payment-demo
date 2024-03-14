<?php

namespace App\Model;

use App\Config;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\Regex;

class CalculatePriceRequest implements RequestInterface
{
    #[Positive]
    private ?int $product = null;

    #[NotBlank]
    #[Regex (Config::TAX_NUMBER_MASK)]
    private ?string $taxNumber = null;

    #[Regex (Config::COUPON_CODE_MASK)]
    private ?string $couponCode = null;

    public function getProduct(): ?int
    {
        return $this->product;
    }

    public function setProduct(?int $product): self
    {
        $this->product = $product;
        return $this;
    }

    public function getTaxNumber(): ?string
    {
        return $this->taxNumber;
    }

    public function setTaxNumber(?string $taxNumber): self
    {
        $this->taxNumber = $taxNumber;
        return $this;
    }

    public function getCouponCode(): ?string
    {
        return $this->couponCode;
    }

    public function setCouponCode(?string $couponCode): self
    {
        $this->couponCode = $couponCode;
        return $this;
    }
}