<?php

namespace HeyJorgeDev\QStash\Contracts\Resources;

use HeyJorgeDev\QStash\ValueObjects\Message;
use HeyJorgeDev\QStash\ValueObjects\MessageToPublish;

interface MessageInterface
{
    public function publish(MessageToPublish $message);

    public function enqueue();

    public function batch();

    public function get(string $messageId): Message;

    public function cancel(string $messageId);

    /**
     * @param  array<string>  $messageIds
     */
    public function bulkCancel(array $messageIds);
}
