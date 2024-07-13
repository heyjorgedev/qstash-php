<?php

namespace HeyJorgeDev\QStash\Models;

class Queue
{
    public function __construct(
        public readonly string $name,
        public readonly int $parallelism,
        public readonly int $lag,
        public readonly int $createdAt,
        public readonly int $updatedAt,
    ) {}
}
