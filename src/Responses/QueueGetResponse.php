<?php

namespace HeyJorgeDev\QStash\Responses;

use HeyJorgeDev\QStash\Contracts\ResponseInterface;
use HeyJorgeDev\QStash\ValueObjects\Queue;

class QueueGetResponse implements ResponseInterface
{
    public function __construct(
        protected int $statusCode,
        protected array $data,
        protected array $errors
    ) {}

    public function isSuccessful(): bool
    {
        return $this->statusCode === 200;
    }

    public function getData(): ?Queue
    {
        if (! $this->isSuccessful()) {
            return null;
        }

        return new Queue(...$this->data);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
