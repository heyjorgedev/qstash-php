<?php

namespace HeyJorgeDev\QStash\ValueObjects\Transporter;

readonly class Headers
{
    public function __construct(private array $headers = []) {}

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

    /**
     * @param  array<string>|string  $value
     */
    public function with(string $key, array|string $value): self
    {
        return new self([
            ...$this->headers,
            $key => $value,
        ]);
    }

    public function merge(Headers $headers): self
    {
        return new self([
            ...$this->toArray(),
            ...$headers->toArray(),
        ]);
    }
}
