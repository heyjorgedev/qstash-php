<?php

namespace HeyJorgeDev\QStash\Tests\Mocks;

use DateTimeImmutable;
use Psr\Clock\ClockInterface;

class MockClock implements ClockInterface
{
    public function __construct(protected \DateTimeImmutable $now) {}

    public function now(): DateTimeImmutable
    {
        return $this->now;
    }
}
