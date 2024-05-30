<?php

namespace App\Shared\Infrastructure\Listener;

use App\Shared\Application\Exception\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class ValidationExceptionListener
{
    public function __construct(private readonly SerializerInterface $serializer)
    {
    }

    public function __invoke(ExceptionEvent $event): void
    {
        $throwable = $event->getThrowable();
        if (!($throwable instanceof ValidationException)) {
            return;
        }

        $data = $this->serializer->serialize([
            'message' => $throwable->getMessage(),
            'detail' => $throwable->getViolations()
        ], JsonEncoder::FORMAT);

        $event->setResponse(new JsonResponse($data, Response::HTTP_BAD_REQUEST, [], true));
    }
}