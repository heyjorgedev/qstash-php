<?php

namespace HeyJorgeDev\QStash\ValueObjects;

readonly class Queue
{
    public function __construct(
        public string $name = '',
        public int $parallelism = 0,
        public int $lag = 0,
        public bool $paused = false,
        public int $createdAt = 0,
        public int $updatedAt = 0,
    ) {}
}
