<?php

namespace HeyJorgeDev\QStash\Responses;

use HeyJorgeDev\QStash\Contracts\ResponseWithDataInterface;
use HeyJorgeDev\QStash\ValueObjects\Message;

class MessagePublishResponse implements ResponseWithDataInterface
{
    public function __construct(
        protected int $statusCode,
        protected array $data,
        protected array $errors,
    ) {}

    public function isSuccessful(): bool
    {
        return $this->statusCode === 201;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getData(): Message
    {
        return new Message(
            id: $this->data['messageId'],
            deduplicated: $this->data['deduplicated'] ?? false,
        );
    }
}
