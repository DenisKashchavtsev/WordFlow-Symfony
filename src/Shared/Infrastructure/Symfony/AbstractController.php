<?php

namespace App\Shared\Infrastructure\Symfony;

use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\Query\QueryBusInterface;

abstract class AbstractController
{
    public function __construct(
        protected readonly QueryBusInterface   $queryBus,
        protected readonly CommandBusInterface $commandBus,
    )
    {
    }
}