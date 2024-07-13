<?php

namespace HeyJorgeDev\QStash\Contracts\Resources;

use HeyJorgeDev\QStash\Responses\QueueDeleteResponse;
use HeyJorgeDev\QStash\Responses\QueueGetResponse;
use HeyJorgeDev\QStash\Responses\QueueListResponse;

interface QueueInterface
{
    public function list(): QueueListResponse;

    public function get(string $queueName): QueueGetResponse;

    public function delete(string $queueName): QueueDeleteResponse;
}
