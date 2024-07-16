<?php

namespace HeyJorgeDev\QStash\ValueObjects;

readonly class UpsertQueue
{
    public function __construct(
        public string $name,
        public int $parallelism = 1,
    ) {}

    public function toArray(): array
    {
        return [
            'queueName' => $this->name,
            'parallelism' => $this->parallelism,
        ];
    }
}
