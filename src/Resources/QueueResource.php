<?php

namespace HeyJorgeDev\QStash\Resources;

use HeyJorgeDev\QStash\Contracts\Resources\QueueInterface;
use HeyJorgeDev\QStash\Contracts\TransporterInterface;

class QueueResource implements QueueInterface
{
    public function __construct(private readonly TransporterInterface $transporter) {}

    public function list()
    {
        // TODO: Implement list() method.
    }

    public function get(string $queueName)
    {
        // TODO: Implement get() method.
    }

    public function delete(string $queueName)
    {
        // TODO: Implement delete() method.
    }
}
