<?php

namespace App\Shared\Infrastructure\Symfony;

use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\Query\QueryBusInterface;
use Symfony\Component\Serializer\SerializerInterface;

abstract class AbstractController
{
    public function __construct(
        protected readonly QueryBusInterface   $queryBus,
        protected readonly CommandBusInterface $commandBus,
        protected readonly SerializerInterface $serializer
    )
    {
    }
}