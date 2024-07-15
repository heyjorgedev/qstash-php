<?php

namespace HeyJorgeDev\QStash\Responses;

use HeyJorgeDev\QStash\Contracts\ResponseInterface;

class MessageCancelResponse implements ResponseInterface
{
    public function __construct(
        protected int $statusCode,
        protected array $errors,
    ) {}

    public function isSuccessful(): bool
    {
        return $this->statusCode === 202;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
