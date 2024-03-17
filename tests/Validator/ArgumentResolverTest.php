<?php

namespace App\Tests\Validator;

use App\Attributes\RequestBody;
use App\Model\CalculatePriceRequest;
use App\Model\PurchaseRequest;
use App\Validator\ArgumentResolver;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ArgumentResolverTest extends TestCase
{
    private readonly ConstraintViolationListInterface $violationList;
    private readonly ValidatorInterface $validator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->violationList= $this->createMock(ConstraintViolationListInterface::class);
        $this->validator= $this->createMock(ValidatorInterface::class);
    }
    public function testResolveCalculatePriceRequest(): void
    {
        $request = new Request([], [], [], [], [], [], json_encode([
            'product' => 1,
            'taxNumber' => 'GR123456789',
            'couponCode' => '3X3GPYG4'
        ]));

        $argument = new ArgumentMetadata(
            'request',
            'App\Model\CalculatePriceRequest',
            false,
            false,
            null,
            false,
            [new RequestBody()]
        );

        $expected = (new CalculatePriceRequest())
            ->setProduct(1)
            ->setTaxNumber('GR123456789')
            ->setCouponCode('3X3GPYG4');

        $this->validator->expects($this->once())
            ->method('validate')
            ->with($expected)
            ->willReturn($this->violationList);

        $response =  $this->createResolver()->resolve($request, $argument);
        $this->assertEquals([$expected], $response);
    }

    public function testResolvePurchaseRequest(): void
    {
        $request = new Request([], [], [], [], [], [], json_encode([
            'product' => 1,
            'taxNumber' => 'GR123456',
            'couponCode' => '3X3GPYG4',
            'paymentProcessor' => 'paypal'
        ]));

        $argument = new ArgumentMetadata(
            'request',
            'App\Model\PurchaseRequest',
            false,
            false,
            null,
            false,
            [new RequestBody()]
        );

        $expected = (new PurchaseRequest())
            ->setProduct(1)
            ->setTaxNumber('GR123456')
            ->setCouponCode('3X3GPYG4')
            ->setPaymentProcessor('paypal');

        $this->validator->expects($this->once())
            ->method('validate')
            ->with($expected)
            ->willReturn($this->violationList);

        $response =  $this->createResolver()->resolve($request, $argument);
        $this->assertEquals([$expected], $response);
    }

    private function createResolver(): ArgumentResolver
    {
        return new ArgumentResolver($this->validator);
    }
}
