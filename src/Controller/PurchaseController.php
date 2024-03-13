<?php

namespace App\Controller;

use App\Model\PurchaseRequest;
use App\PriceCalculator\PriceCalculator;
use App\PurchaseHandler\PurchaseHandler;
use App\Validator\ArgumentResolver\RequestBody;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PurchaseController extends AbstractController
{
    public function __construct(
        private readonly PriceCalculator $priceCalculator,
        private readonly PurchaseHandler $purchaseHandler
    )
    {
    }

    #[Route('/purchase', methods: ['POST'])]
    public function purchase(#[RequestBody] PurchaseRequest $request): Response
    {
        $sum = $this->priceCalculator->calc($request);
        $this->purchaseHandler->purchase($request, $sum);

        return new JsonResponse();
    }
}