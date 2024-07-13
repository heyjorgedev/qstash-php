<?php

namespace HeyJorgeDev\QStash\Responses;

use HeyJorgeDev\QStash\Contracts\ResponseInterface;

class QueueDeleteResponse implements ResponseInterface
{
    public function __construct(
        protected int $statusCode,
        protected array $errors
    ) {}

    public function isSuccessful(): bool
    {
        return $this->statusCode === 200;
    }

    public function getData(): void {}

    public function getErrors(): array
    {
        return $this->errors;
    }
}
