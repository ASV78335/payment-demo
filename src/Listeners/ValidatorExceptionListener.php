<?php

namespace App\Listeners;

use App\Exceptions\RequestConvertException;
use App\Exceptions\RequestValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ValidatorExceptionListener
{
    public function __invoke(ExceptionEvent $event):void
    {
        $throwable = $event->getThrowable();

        if ($throwable instanceof RequestConvertException) {
            $event->setResponse(new JsonResponse($throwable->getMessage(), Response::HTTP_BAD_REQUEST));
        }
        elseif ($throwable instanceof RequestValidationException) {
            $event->setResponse(new JsonResponse(
                $throwable->getViolations()[0]->getPropertyPath() . ': ' . $throwable->getViolations()[0]->getMessage(),
            Response::HTTP_BAD_REQUEST));
        }
    }
}
