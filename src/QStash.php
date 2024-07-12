<?php

namespace HeyJorgeDev\QStash;

class QStash
{
    public static function client(string $token): Client
    {
        return new Client($token);
    }
}
