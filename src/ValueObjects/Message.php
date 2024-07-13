<?php

namespace HeyJorgeDev\QStash\ValueObjects;

class Message
{
    public static function to(string $url): MessageToPublish
    {
        return MessageToPublish::to($url);
    }
}
