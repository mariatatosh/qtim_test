<?php

declare(strict_types=1);

namespace App\EventListener;

use App\Exception\RequestBodyValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

final class RequestBodyValidationFailed
{
    public function __invoke(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if (! $exception instanceof RequestBodyValidationException) {
            return;
        }

        $event->setResponse(
            new JsonResponse([
                'errors' => $exception->getErrors()
            ])
        );
    }
}