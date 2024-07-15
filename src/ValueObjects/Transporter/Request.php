<?php

namespace HeyJorgeDev\QStash\ValueObjects\Transporter;

use GuzzleHttp\Psr7\Request as Psr7Request;
use HeyJorgeDev\QStash\ValueObjects\Url;

class Request
{
    public function __construct(
        public readonly string $method = 'GET',
        public readonly Url $url = new Url(''),
        public readonly Headers $headers = new Headers([]),
        public string|array|null $body = null,
    ) {}

    public function withMethod(string $method): self
    {
        return new self(
            method: $method,
            url: $this->url,
            headers: $this->headers,
            body: $this->body,
        );
    }

    public function withUrl(string|Url $url): self
    {
        return new self(
            method: $this->method,
            url: is_string($url) ? new Url($url) : $url,
            headers: $this->headers,
            body: $this->body,
        );
    }

    public function withHeaders(Headers $headers): self
    {
        return new self(
            method: $this->method,
            url: $this->url,
            headers: $headers,
            body: $this->body,
        );
    }

    public function appendHeaders(Headers $headers): self
    {
        return $this->withHeaders($this->headers->merge($headers));
    }

    public function toPsr7Request(): Psr7Request
    {
        return new Psr7Request(
            method: $this->method,
            uri: $this->url->toString(),
            headers: $this->headers->toArray(),
            body: $this->body,
        );
    }

    public function withBody(string|array|null $body): self
    {
        return new self(
            method: $this->method,
            url: $this->url,
            headers: $this->headers,
            body: $body,
        );
    }
}
