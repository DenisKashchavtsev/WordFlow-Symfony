<?php

namespace App\Shared\Infrastructure\Listener;

use App\Shared\Application\Exception\ValidationException;
use phpDocumentor\Reflection\File;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class ExceptionListener
{
    public function __construct(private readonly SerializerInterface $serializer)
    {
    }

    public function __invoke(ExceptionEvent $event): void
    {
        $throwable = $event->getThrowable();

        $data = [
            'message' => $throwable->getMessage(),
            'code' => $throwable->getCode(),
            'trace' => array_map(function ($trace) {
                return [
                    'file' => $trace['file'] ?? 'N/A',
                    'line' => $trace['line'] ?? 'N/A',
                ];
            }, $throwable->getTrace()),
        ];

        $event->setResponse(new JsonResponse(json_encode($data), Response::HTTP_BAD_REQUEST, [], true));
    }
}