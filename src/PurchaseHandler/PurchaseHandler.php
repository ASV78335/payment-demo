<?php

namespace App\PurchaseHandler;

use App\Exceptions\BusinessLogicException;
use App\Model\PurchaseRequest;
use App\PurchaseHandler\PaymentAdapters\PaymentInterface;
use Exception;
use HaydenPierce\ClassFinder\ClassFinder;
use ReflectionClass;
use ReflectionException;

class PurchaseHandler
{
    /**
     * @throws ReflectionException
     */
    public function purchase(PurchaseRequest $request, float $sum): bool
    {
        $paymentAdapter = $this->getPaymentAdapter($request->getPaymentProcessor(), __NAMESPACE__ . '\PaymentAdapters');
        return $paymentAdapter->pay($sum);
    }

    /**
     * Looking for a payment adapter in specified namespace
     *
     * @throws ReflectionException
     * @throws Exception
     */
    public function getPaymentAdapter($name, $path): PaymentInterface
    {
        $adapter = null;

        $allClasses = ClassFinder::getClassesInNamespace($path);
        foreach ($allClasses as $class) {
            $reflectionClass = new ReflectionClass($class);
            $attributes = $reflectionClass->getAttributes();

            foreach ($attributes as $attribute) {
                if ($attribute->getName() === 'App\Attributes\AsPaymentAdapter' && $attribute->getArguments() === [$name]) {
                    $adapter = new $class();
                    break;
                }
            }
        }
        if (!$adapter) throw new BusinessLogicException('Payment adapter not found');

        return $adapter;
    }
}
