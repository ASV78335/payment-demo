<?php

namespace App\Tests\PriceCalculator;

use App\Model\CalculatePriceRequest;
use App\PriceCalculator\PriceCalculator;
use App\Repository\CouponRepository;
use App\Repository\ProductRepository;
use PHPUnit\Framework\TestCase;

class PriceCalculatorTest extends TestCase
{
    private readonly CouponRepository $couponRepository;
    private readonly ProductRepository $productRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->couponRepository= $this->createMock(CouponRepository::class);
        $this->productRepository = $this->createMock(ProductRepository::class);
    }

    public function testCalc(): void
    {
        $request = (new CalculatePriceRequest())
            ->setProduct(1)
            ->setTaxNumber('GR123456789')
            ->setCouponCode('3X3GPYG4')
        ;

        $this->couponRepository->expects($this->once())
            ->method('existsByCode')
            ->with('3X3GPYG4')
            ->willReturn(true);

        $this->couponRepository->expects($this->once())
            ->method('findByCode')
            ->with('3X3GPYG4')
            ->willReturn([
                "code" => "3X3GPYG4",
                "type" => 1,
                "discount" => 6]);

        $this->productRepository->expects($this->once())
            ->method('existsById')
            ->with(1)
            ->willReturn(true);

        $this->productRepository->expects($this->once())
            ->method('findPriceById')
            ->with(1)
            ->willReturn(10000);

        $response =  $this->createCalculator()->calc($request);
        $this->assertEquals('116.56', $response);
    }

    private function createCalculator(): PriceCalculator
    {
        return new PriceCalculator(
            $this->couponRepository,
            $this->productRepository
        );
    }
}
