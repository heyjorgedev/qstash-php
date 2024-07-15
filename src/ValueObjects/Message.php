<?php

namespace HeyJorgeDev\QStash\ValueObjects;

class Message
{
    public function __construct(
        public readonly string $id,
    ) {}

    public static function to(Url|TopicName $url): MessageToPublish
    {
        return MessageToPublish::to($url);
    }
}
