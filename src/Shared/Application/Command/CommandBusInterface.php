<?php

namespace App\Shared\Application\Command;

interface CommandBusInterface
{
    public function execute(CommandInterface $command): mixed;
}