<?php

namespace HeyJorgeDev\QStash\Contracts\Resources;

use HeyJorgeDev\QStash\ValueObjects\Message;

interface MessageInterface
{
    public function publish();

    public function enqueue();

    public function batch();

    public function get(string $messageId): Message;

    public function cancel(string $messageId);

    /**
     * @param  array<string>  $messageIds
     */
    public function bulkCancel(array $messageIds);
}
