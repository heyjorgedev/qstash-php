<?php

namespace HeyJorgeDev\QStash\ValueObjects;

readonly class TopicName
{
    public function __construct(public string $name) {}

    public function toString(): string
    {
        return $this->name;
    }
}
