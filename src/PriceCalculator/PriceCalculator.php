<?php

namespace App\PriceCalculator;

use App\Config;
use App\Model\RequestInterface;
use App\Repository\CouponRepository;
use App\Repository\ProductRepository;

class PriceCalculator
{
    public function __construct(
        private readonly CouponRepository $couponRepository,
        private readonly ProductRepository $productRepository,
    )
    {
    }

    public function calc(RequestInterface $request): float
    {
        $productPrice = $this->extractProductPrice($request->getProduct());

        $couponCode = $request->getCouponCode();
        $discount = $couponCode ? $this->calcDiscount($productPrice, $couponCode) : 0;

        $taxAmount = $this->calcTax($productPrice - $discount, $request->getTaxNumber());

        return round($productPrice - $discount + $taxAmount) / 100;
    }

    private function extractProductPrice(int $id): int
    {
        if (!$this->productRepository->existsById($id)) throw new BusinessLogicException('Product not found');
        return $this->productRepository->findPriceById($id);
    }

    private function calcDiscount(int $price, string $code): int
    {
        if (!$this->couponRepository->existsByCode($code)) throw new BusinessLogicException('Coupon not found');
        $coupon = $this->couponRepository->findByCode($code);

        return match ($coupon['type']) {
            1 => $price * $coupon['discount'] / 100,    // Percentage discount
            2 => $coupon['discount'],                   // Fixed amount
            default => 0
        };
    }

    private function calcTax(int $sum, string $taxNumber): int
    {
        $tax = Config::COUNTRY_TAXES[substr($taxNumber, 0, 2)];
        return $sum * $tax / 100;
    }

}