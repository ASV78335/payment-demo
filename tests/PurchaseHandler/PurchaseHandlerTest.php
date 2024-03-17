<?php

namespace App\Tests\PurchaseHandler;

use App\Exceptions\BusinessLogicException;
use App\Model\PurchaseRequest;
use App\PurchaseHandler\PurchaseHandler;
use PHPUnit\Framework\TestCase;

class PurchaseHandlerTest extends TestCase
{
    public function testPurchase(): void
    {
        $request = (new PurchaseRequest())
            ->setProduct(1)
            ->setTaxNumber('GR123456789')
            ->setCouponCode('3X3GPYG4')
            ->setPaymentProcessor('stripe');

        $this->assertTrue($this->createHandler()->purchase($request, 116.56));
    }

    public function testPurchaseBusinessLogicException(): void
    {
        $this->expectException(BusinessLogicException::class);
        $this->expectExceptionMessage('Payment adapter not found');

        $request = (new PurchaseRequest())
            ->setProduct(1)
            ->setTaxNumber('GR123456789')
            ->setCouponCode('3X3GPYG4')
            ->setPaymentProcessor('test');

        $this->createHandler()->purchase($request, 116.56);
    }

    private function createHandler(): PurchaseHandler
    {
        return new PurchaseHandler();
    }
}
