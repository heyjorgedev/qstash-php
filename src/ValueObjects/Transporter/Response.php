<?php

namespace HeyJorgeDev\QStash\ValueObjects\Transporter;

class Response
{
    public function __construct(
        public readonly int $statusCode = 200,
        public readonly ?array $body = null,
        public readonly Headers $headers = new Headers([]),
    ) {}
}
