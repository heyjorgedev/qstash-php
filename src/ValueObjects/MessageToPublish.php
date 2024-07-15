<?php

namespace HeyJorgeDev\QStash\ValueObjects;

use HeyJorgeDev\QStash\ValueObjects\Transporter\Headers;

class MessageToPublish
{
    public function __construct(
        public readonly Url|TopicName $destination,
        public readonly array|string $body = [],
        private int $delay = 0,
        private int $retries = 0,
        private string $method = 'GET',
        private ?Url $callbackUrl = null,
        private ?Url $failureCallbackUrl = null,
        private Headers $headers = new Headers([]),
        private string $deduplicationId = '',
        private bool $contentBasedDeduplication = false,
    ) {}

    public static function to(Url|TopicName $url): self
    {
        return new self(destination: $url);
    }

    public function withBody(array|string $body): self
    {
        $message = new self(
            destination: $this->destination,
            body: $body,
            delay: $this->delay,
            retries: $this->retries,
            method: $this->method,
            callbackUrl: $this->callbackUrl,
            failureCallbackUrl: $this->failureCallbackUrl,
            headers: $this->headers,
            deduplicationId: $this->deduplicationId,
            contentBasedDeduplication: $this->contentBasedDeduplication,
        );

        if (is_array($body)) {
            return $message->asJson();
        }

        return $message;
    }

    public function withMaxRetries(int $retries): self
    {
        return new self(
            destination: $this->destination,
            body: $this->body,
            delay: $this->delay,
            retries: $retries,
            method: $this->method,
            callbackUrl: $this->callbackUrl,
            failureCallbackUrl: $this->failureCallbackUrl,
            headers: $this->headers,
            deduplicationId: $this->deduplicationId,
            contentBasedDeduplication: $this->contentBasedDeduplication,
        );
    }

    public function withDelay(int $days = 0, int $hours = 0, int $minutes = 0, int $seconds = 0): self
    {
        $oneMinute = 60;
        $oneHour = 60 * $oneMinute;
        $oneDay = 24 * $oneHour;

        $delay = $seconds + ($minutes * $oneMinute) + ($hours * $oneHour) + ($days * $oneDay);

        return new self(
            destination: $this->destination,
            body: $this->body,
            delay: $delay,
            retries: $this->retries,
            method: $this->method,
            callbackUrl: $this->callbackUrl,
            failureCallbackUrl: $this->failureCallbackUrl,
            headers: $this->headers,
            deduplicationId: $this->deduplicationId,
            contentBasedDeduplication: $this->contentBasedDeduplication,
        );
    }

    public function withMethod(string $method): self
    {
        return new self(
            destination: $this->destination,
            body: $this->body,
            delay: $this->delay,
            retries: $this->retries,
            method: strtoupper($method),
            callbackUrl: $this->callbackUrl,
            failureCallbackUrl: $this->failureCallbackUrl,
            headers: $this->headers,
            deduplicationId: $this->deduplicationId,
            contentBasedDeduplication: $this->contentBasedDeduplication,
        );
    }

    public function withPost(): self
    {
        return $this->withMethod('POST');
    }

    public function withGet(): self
    {
        return $this->withMethod('GET');
    }

    public function withPut(): self
    {
        return $this->withMethod('PUT');
    }

    public function withDelete(): self
    {
        return $this->withMethod('DELETE');
    }

    public function withCallback(Url $callback): self
    {
        return new self(
            destination: $this->destination,
            body: $this->body,
            delay: $this->delay,
            retries: $this->retries,
            method: $this->method,
            callbackUrl: $callback,
            headers: $this->headers,
            deduplicationId: $this->deduplicationId,
            contentBasedDeduplication: $this->contentBasedDeduplication,
        );
    }

    public function withFailureCallback(Url $callback): self
    {
        return new self(
            destination: $this->destination,
            body: $this->body,
            delay: $this->delay,
            retries: $this->retries,
            method: $this->method,
            callbackUrl: $this->callbackUrl,
            failureCallbackUrl: $callback,
            headers: $this->headers,
            deduplicationId: $this->deduplicationId,
            contentBasedDeduplication: $this->contentBasedDeduplication,
        );
    }

    /**
     * @param  Headers|array<string, string|array<string>>  $headers
     */
    public function withHeaders(Headers|array $headers): self
    {
        if (is_array($headers)) {
            $headers = new Headers($headers);
        }

        return new self(
            destination: $this->destination,
            body: $this->body,
            delay: $this->delay,
            retries: $this->retries,
            method: $this->method,
            callbackUrl: $this->callbackUrl,
            failureCallbackUrl: $this->failureCallbackUrl,
            headers: $headers,
            deduplicationId: $this->deduplicationId,
            contentBasedDeduplication: $this->contentBasedDeduplication,
        );
    }

    public function withHeader(string $key, string|array $value): self
    {
        $headers = new Headers([...$this->headers->toArray(), $key => $value]);

        return $this->withHeaders($headers);
    }

    public function withDeduplicationId(string $id): self
    {
        return new self(
            destination: $this->destination,
            body: $this->body,
            delay: $this->delay,
            retries: $this->retries,
            method: $this->method,
            callbackUrl: $this->callbackUrl,
            failureCallbackUrl: $this->failureCallbackUrl,
            headers: $this->headers,
            deduplicationId: $id,
            contentBasedDeduplication: $this->contentBasedDeduplication,
        );
    }

    public function withContentBasedDeduplication(bool $value = true): self
    {
        return new self(
            destination: $this->destination,
            body: $this->body,
            delay: $this->delay,
            retries: $this->retries,
            method: $this->method,
            callbackUrl: $this->callbackUrl,
            failureCallbackUrl: $this->failureCallbackUrl,
            headers: $this->headers,
            deduplicationId: $this->deduplicationId,
            contentBasedDeduplication: $value,
        );
    }

    public function toUpstashHeaders(): Headers
    {
        $headers = new Headers([
            'Upstash-Method' => strtoupper($this->method),
        ]);

        if ($this->callbackUrl) {
            $headers = $headers->with('Upstash-Callback', $this->callbackUrl->toString());
        }

        if ($this->failureCallbackUrl) {
            $headers = $headers->with('Upstash-Failure-Callback', $this->failureCallbackUrl->toString());
        }

        if ($this->deduplicationId) {
            $headers = $headers->with('Upstash-Deduplication-Id', $this->deduplicationId);
        }

        if ($this->contentBasedDeduplication) {
            $headers = $headers->with('Upstash-Content-Based-Deduplication', 'true');
        }

        if ($this->headers) {
            foreach ($this->headers->toArray() as $key => $value) {
                $headers = $headers->with(sprintf('Upstash-Forward-%s', $key), $value);
            }
        }

        if ($this->delay > 0) {
            $headers = $headers->with('Upstash-Delay', sprintf('%ds', $this->delay));
        }

        if ($this->retries > 0) {
            $headers = $headers->with('Upstash-Retries', $this->retries);
        }

        return $headers;
    }

    public function asJson(): self
    {
        return $this->withHeader('Content-Type', 'application/json');
    }

    public function asHtml(): self
    {
        return $this->withHeader('Content-Type', 'text/html');
    }
}
