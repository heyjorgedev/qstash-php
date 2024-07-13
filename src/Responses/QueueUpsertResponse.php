<?php

namespace HeyJorgeDev\QStash\Responses;

use HeyJorgeDev\QStash\Contracts\ResponseInterface;

class QueueUpsertResponse implements ResponseInterface
{
    public function __construct(
        private readonly int $statusCode,
        private readonly array $errors = [],
    ) {}

    public function isSuccessful(): bool
    {
        return $this->statusCode === 200;
    }

    public function getErrors(): array
    {
        if ($this->isSuccessful()) {
            return [];
        }

        $errors = $this->errors;

        if ($this->statusCode === 412) {
            $errors[] = 'Allowed number of queues exceeded';
        }

        return $errors;
    }
}
