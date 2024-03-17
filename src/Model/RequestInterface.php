<?php

namespace App\Model;

interface RequestInterface
{
    public function getProduct(): ?int;

    public function setProduct(?int $product): self;

    public function getTaxNumber(): ?string;

    public function setTaxNumber(?string $taxNumber): self;

    public function getCouponCode(): ?string;

    public function setCouponCode(?string $couponCode): self;
}
