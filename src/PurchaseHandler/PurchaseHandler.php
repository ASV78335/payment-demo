<?php

namespace App\PurchaseHandler;

use App\Model\PurchaseRequest;
use App\PriceCalculator\BusinessLogicException;
use Exception;
use HaydenPierce\ClassFinder\ClassFinder;
use ReflectionClass;
use ReflectionException;

class PurchaseHandler
{
    /**
     * @throws ReflectionException
     */
    public function purchase(PurchaseRequest $request, float $sum): void
    {
        $paymentAdapter = $this->getPaymentAdapter($request->getPaymentProcessor(), __NAMESPACE__);
        $paymentAdapter->pay($sum);
    }

    /**
     * Looking for payment adapter in specified namespace
     *
     * @throws ReflectionException
     * @throws Exception
     */
    private function getPaymentAdapter($name, $path): PaymentInterface
    {
        $adapter = null;

        $allClasses = ClassFinder::getClassesInNamespace($path);

        foreach ($allClasses as $class) {
            $reflectionClass = new ReflectionClass($class);
            $attributes = $reflectionClass->getAttributes();

            foreach ($attributes as $attribute) {
                if ($attribute->getName() === __NAMESPACE__ . '\AsPaymentAdapter' && $attribute->getArguments() === [$name]) {
                    $adapter = new $class();
                    break;
                }
            }
        }
        if (!$adapter) throw new BusinessLogicException('Payment adapter not found');

        return $adapter;
    }
}