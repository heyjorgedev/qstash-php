<?php

namespace HeyJorgeDev\QStash\ValueObjects\Transporter;

class Headers
{
    public function __construct(private readonly array $headers = []) {}

    public function withAuthorization(?string $apiKey): Headers
    {
        return new self([
            ...$this->headers,
            'Authorization' => "Bearer $apiKey",
        ]);
    }

    public function toArray(): array
    {
        return $this->headers;
    }
}
