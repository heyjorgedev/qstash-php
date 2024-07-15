<?php

namespace HeyJorgeDev\QStash\ValueObjects;

class Message
{
    public function __construct(
        public readonly string $id,
        public readonly bool $deduplicated = false,
    ) {}

    public static function to(Url|TopicName $url): MessageToPublish
    {
        return MessageToPublish::to($url);
    }
}
