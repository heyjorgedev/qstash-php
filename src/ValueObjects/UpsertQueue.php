<?php

namespace HeyJorgeDev\QStash\ValueObjects;

class UpsertQueue
{
    public function __construct(
        public readonly string $name,
        public readonly int $parallelism = 1,
    ) {}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'parallelism' => $this->parallelism,
        ];
    }
}
