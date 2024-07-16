<?php

namespace HeyJorgeDev\QStash\Support;

use Psr\Clock\ClockInterface;

readonly class SystemClock implements ClockInterface
{
    public function __construct(
        private ?\DateTimeZone $timezone = null
    ) {}

    public function now(): \DateTimeImmutable
    {
        return new \DateTimeImmutable('now', $this->timezone);
    }
}
