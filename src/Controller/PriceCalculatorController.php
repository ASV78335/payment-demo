<?php

namespace App\Controller;

use App\FrontService\ArgumentResolver\RequestBody;
use App\Model\CalculatePriceRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PriceCalculatorController extends AbstractController
{
    #[Route('/calculate-price', methods: ['POST'])]
    public function calculate(#[RequestBody] CalculatePriceRequest $request): Response
    {
//        dd($request);
        return $this->json($request);
    }
}