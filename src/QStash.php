<?php

namespace HeyJorgeDev\QStash;

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
}
