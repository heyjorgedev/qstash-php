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

    public static function GET(string|Url $url): self
    {
        return (new self(method: 'GET'))
            ->withUrl($url);
    }

    public static function POST(string|Url $url, string|array|null $body = null): self
    {
        return (new self(method: 'POST'))
            ->withUrl($url)
            ->withBody($body);
    }

    public static function PUT(string|Url $url, string|array|null $body = null): self
    {
        return (new self(method: 'PUT'))
            ->withUrl($url)
            ->withBody($body);
    }

    public static function DELETE(string|Url $url): self
    {
        return (new self(method: 'DELETE'))
            ->withUrl($url);
    }

    public function withMethod(string $method): self
    {
        return new self(
            method: strtoupper($method),
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

    public function withBody(string|array|null $body): self
    {
        return new self(
            method: $this->method,
            url: $this->url,
            headers: $this->headers,
            body: $body,
        );
    }

    public function withBaseUrl(Url $baseUrl): self
    {
        return $this->withUrl($baseUrl->append($this->url->toString()));
    }

    public function toPsr7Request(): Psr7Request
    {
        return new Psr7Request(
            method: $this->method,
            uri: $this->url->toString(),
            headers: $this->headers->toArray(),
            body: is_array($this->body) ? json_encode($this->body) : $this->body,
        );
    }
}
