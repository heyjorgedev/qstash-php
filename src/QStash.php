<?php

namespace HeyJorgeDev\QStash;

use HeyJorgeDev\QStash\Support\SystemClock;
use Psr\Clock\ClockInterface;

class QStash
{
    public static function client(#[\SensitiveParameter] string $apiKey): Client
    {
        return self::factory()
            ->withApiKey($apiKey)
            ->withBaseUrl('https://qstash.upstash.io/v2/')
            ->make();
    }

    public static function factory(): Factory
    {
        return new Factory();
    }

    /**
     * @param  array<string>  $signingKeys
     */
    public static function receiver(array $signingKeys, ?ClockInterface $clock = null): Receiver
    {
        return new Receiver($clock ?? new SystemClock(), $signingKeys);
    }
}
