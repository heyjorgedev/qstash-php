<?php

namespace HeyJorgeDev\QStash\Contracts\Resources;

use HeyJorgeDev\QStash\Responses\QueueDeleteResponse;
use HeyJorgeDev\QStash\Responses\QueueGetResponse;
use HeyJorgeDev\QStash\Responses\QueueListResponse;
use HeyJorgeDev\QStash\Responses\QueueUpsertResponse;
use HeyJorgeDev\QStash\ValueObjects\UpsertQueue;

interface QueueInterface
{
    public function upsert(UpsertQueue $queue): QueueUpsertResponse;

    public function list(): QueueListResponse;

    public function get(string $queueName): QueueGetResponse;

    public function delete(string $queueName): QueueDeleteResponse;
}
