<?php

namespace HeyJorgeDev\QStash\Responses;

use HeyJorgeDev\QStash\Contracts\ResponseWithDataInterface;
use HeyJorgeDev\QStash\ValueObjects\Message;

class MessagePublishResponse implements ResponseWithDataInterface
{
    public function isSuccessful(): bool
    {
        // TODO: Implement isSuccessful() method.
    }

    public function getErrors(): array
    {
        // TODO: Implement getErrors() method.
    }

    public function getData(): Message
    {
        return new Message();
    }
}
