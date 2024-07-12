<?php

namespace HeyJorgeDev\QStash\Contracts\Resources;

interface MessageInterface
{
    public function publish();

    public function enqueue();

    public function batch();

    public function get(string $messageId);

    public function cancel(string $messageId);

    /**
     * @param  array<string>  $messageIds
     */
    public function bulkCancel(array $messageIds);
}
