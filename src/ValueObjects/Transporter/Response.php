<?php

namespace HeyJorgeDev\QStash\ValueObjects\Transporter;

class Response
{
    public function __construct(
        public readonly int $statusCode,
        public readonly array $body,
        public readonly Headers $headers,
    ) {}
}
