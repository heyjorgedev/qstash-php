<?php

namespace HeyJorgeDev\QStash\ValueObjects;

readonly class Message
{
    public function __construct(
        public string $id,
        public bool $deduplicated = false,
    ) {}

    public static function to(Url|TopicName $url): MessageToPublish
    {
        return MessageToPublish::to($url);
    }
}
