<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PurchaseControllerTest extends WebTestCase
{
    public function testCalculate(): void
    {
        $client = static::createClient();
        $client->request('POST', 'purchase', [], [], [], json_encode([
            'product' => 1,
            'taxNumber' => 'GR123456789',
            'couponCode' => '3X3GPYG4',
            'paymentProcessor' => 'paypal'
        ]));

        $this->assertResponseIsSuccessful();
    }
}
