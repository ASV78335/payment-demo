<?php

namespace App\Model;

interface RequestInterface
{
    public function getProduct(): ?int;

    public function setProduct(?int $product): void;

    public function getTaxNumber(): ?string;

    public function setTaxNumber(?string $taxNumber): void;

    public function getCouponCode(): ?string;

    public function setCouponCode(?string $couponCode): void;
}