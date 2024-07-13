<?php

namespace HeyJorgeDev\QStash\ValueObjects;

class TopicName
{
    public function __construct(public readonly string $name) {}

    public function toString(): string
    {
        return $this->name;
    }
}
