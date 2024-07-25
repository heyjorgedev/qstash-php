<?php

namespace HeyJorgeDev\QStash;

use HeyJorgeDev\QStash\Support\SystemClock;
use Psr\Clock\ClockInterface;

class QStash
{
    private static $apiKey;

    public static function key(string $apiKey)
    {
        self::$apiKey = $apiKey;
    }

    public static function client(?string $apiKey = null): Client
    {
        return self::factory()
            ->withApiKey($apiKey ?? self::$apiKey)
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
