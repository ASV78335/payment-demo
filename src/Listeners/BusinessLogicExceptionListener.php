<?php

namespace App\Listeners;

use App\Exceptions\BusinessLogicException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class BusinessLogicExceptionListener
{
    public function __invoke(ExceptionEvent $event):void
    {
        $throwable = $event->getThrowable();

        if ($throwable instanceof BusinessLogicException) {
            $event->setResponse(new JsonResponse($throwable->getMessage(), Response::HTTP_BAD_REQUEST));
        }
    }
}
