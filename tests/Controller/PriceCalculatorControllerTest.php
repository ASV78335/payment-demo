<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PriceCalculatorControllerTest extends WebTestCase
{
    public function testCalculate(): void
    {
        $client = static::createClient();
        $client->request('POST', 'calculate-price', [], [], [], json_encode([
            'product' => 1,
            'taxNumber' => 'GR123456789',
            'couponCode' => '3X3GPYG4'
        ]));

        $this->assertResponseIsSuccessful();
    }
}
