<?php

namespace HeyJorgeDev\QStash;

use HeyJorgeDev\QStash\Support\SystemClock;

class QStash
{
    public static function client(string $apiKey): Client
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
    public static function receiver(array $signingKeys): Receiver
    {
        return new Receiver(new SystemClock(), $signingKeys);
    }
}
