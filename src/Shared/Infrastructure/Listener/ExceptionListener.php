<?php

namespace App\Shared\Infrastructure\Listener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
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