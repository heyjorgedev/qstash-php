<?php

namespace HeyJorgeDev\QStash\Resources;

use HeyJorgeDev\QStash\Contracts\Resources\QueueInterface;
use HeyJorgeDev\QStash\Contracts\TransporterInterface;
use HeyJorgeDev\QStash\Responses\QueueDeleteResponse;
use HeyJorgeDev\QStash\Responses\QueueGetResponse;
use HeyJorgeDev\QStash\Responses\QueueListResponse;

class QueueResource implements QueueInterface
{
    public function __construct(private readonly TransporterInterface $transporter) {}

    public function list(): QueueListResponse
    {
        $response = $this->transporter->request('GET', '/queues');
        if ($response->statusCode !== 200) {
            return new QueueListResponse($response->statusCode, [], $response->body);
        }

        return new QueueListResponse($response->statusCode, $response->body, []);
    }

    public function get(string $queueName): QueueGetResponse
    {
        $response = $this->transporter->request('GET', "/queues/{$queueName}");
        if ($response->statusCode !== 200) {
            return new QueueGetResponse($response->statusCode, [], $response->body);
        }

        return new QueueGetResponse($response->statusCode, $response->body, []);
    }

    public function delete(string $queueName): QueueDeleteResponse
    {
        $response = $this->transporter->request('DELETE', "/queues/{$queueName}");
        if ($response->statusCode !== 200) {
            return new QueueDeleteResponse($response->statusCode, $response->body);
        }

        return new QueueDeleteResponse($response->statusCode, []);
    }
}
