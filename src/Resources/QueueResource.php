<?php

namespace HeyJorgeDev\QStash\Resources;

use HeyJorgeDev\QStash\Contracts\Resources\QueueInterface;
use HeyJorgeDev\QStash\Contracts\TransporterInterface;
use HeyJorgeDev\QStash\Models\Queue;

class QueueResource implements QueueInterface
{
    public function __construct(private readonly TransporterInterface $transporter) {}

    /**
     * @return array<Queue>
     */
    public function list(): array
    {
        $response = $this->transporter->request('GET', '/queues');
        $queues = [];

        foreach ($response->body as $queue) {
            $queues[] = new Queue(...$queue);
        }

        return $queues;
    }

    public function get(string $queueName): Queue
    {
        $response = $this->transporter->request('GET', "/queues/{$queueName}");

        return new Queue(...$response->body);
    }

    public function delete(string $queueName)
    {
        // TODO: Implement delete() method.
    }
}
