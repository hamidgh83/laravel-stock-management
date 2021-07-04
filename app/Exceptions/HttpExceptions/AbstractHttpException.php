<?php

namespace App\Exceptions\HttpExceptions;

use RuntimeException;

abstract class AbstractHttpException extends RuntimeException
{
    protected string $error;

    protected array $extraInfo = [];

    public function __construct(int $statusCode, string $message = null, $extraInfo = [])
    {
        $this->error     = $statusCode;
        $this->extraInfo = $extraInfo;

        parent::__construct($message, $statusCode, null);
    }

    public function getError(): string
    {
        return $this->error;
    }

    public function getExtraInfo(): array
    {
        return $this->extraInfo;
    }
}
