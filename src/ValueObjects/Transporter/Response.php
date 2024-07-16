<?php

namespace HeyJorgeDev\QStash\ValueObjects\Transporter;

readonly class Response
{
    public function __construct(
        public int $statusCode = 200,
        public ?array $body = null,
        public Headers $headers = new Headers([]),
    ) {}

    public function isSuccessful(): bool
    {
        return $this->statusCode >= 200 && $this->statusCode < 300;
    }
}
