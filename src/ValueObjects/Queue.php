<?php

namespace HeyJorgeDev\QStash\ValueObjects;

class Queue
{
    public function __construct(
        public readonly string $name = '',
        public readonly int $parallelism = 0,
        public readonly int $lag = 0,
        public readonly bool $paused = false,
        public readonly int $createdAt = 0,
        public readonly int $updatedAt = 0,
    ) {}
}
