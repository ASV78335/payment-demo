<?php

namespace App\Controller;

use App\Attributes\RequestBody;
use App\Model\CalculatePriceRequest;
use App\PriceCalculator\PriceCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PriceCalculatorController extends AbstractController
{
    public function __construct(private readonly PriceCalculator $priceCalculator)
    {
    }

    #[Route('/calculate-price', methods: ['POST'])]
    public function calculate(#[RequestBody] CalculatePriceRequest $request): Response
    {
        return $this->json($this->priceCalculator->calc($request));
    }
}
