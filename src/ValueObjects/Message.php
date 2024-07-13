<?php

namespace HeyJorgeDev\QStash\ValueObjects;

class Message
{
    public static function to(Url|TopicName $url): MessageToPublish
    {
        return MessageToPublish::to($url);
    }
}
