<?php

namespace App\Shared\Infrastructure\Exception;

class RequestBodyConvertException extends \RuntimeException
{
    public function __construct(\Throwable $previous)
    {
        parent::__construct('error while unmarshalling request body', 0, $previous);
    }
}