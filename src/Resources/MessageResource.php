<?php

namespace HeyJorgeDev\QStash\Resources;

use HeyJorgeDev\QStash\Contracts\Resources\MessageInterface;
use HeyJorgeDev\QStash\Contracts\TransporterInterface;

class MessageResource implements MessageInterface
{
    public function __construct(private readonly TransporterInterface $transporter) {}

    public function publish()
    {
        // TODO: Implement publish() method.
    }

    public function enqueue()
    {
        // TODO: Implement enqueue() method.
    }

    public function batch()
    {
        // TODO: Implement batch() method.
    }

    public function get(string $messageId)
    {
        // TODO: Implement get() method.
    }

    public function cancel(string $messageId)
    {
        // TODO: Implement cancel() method.
    }

    public function bulkCancel(array $messageIds)
    {
        // TODO: Implement bulkCancel() method.
    }
}
