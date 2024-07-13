<?php

namespace HeyJorgeDev\QStash\Responses;

use HeyJorgeDev\QStash\Contracts\ResponseInterface;
use HeyJorgeDev\QStash\ValueObjects\Queue;

class QueueListResponse implements ResponseInterface
{
    /**
     * @param  array<Queue>  $data
     * @param  array<string>  $errors
     */
    public function __construct(protected int $statusCode, protected array $data, protected array $errors) {}

    public function isSuccessful(): bool
    {
        return $this->statusCode === 200;
    }

    /**
     * @return array<Queue>
     */
    public function getData(): array
    {
        if (! $this->isSuccessful()) {
            return [];
        }

        $queues = [];

        foreach ($this->data as $queue) {
            $queues[] = new Queue(...$queue);
        }

        return $queues;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
