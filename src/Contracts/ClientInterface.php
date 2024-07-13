<?php

namespace HeyJorgeDev\QStash\Contracts;

use HeyJorgeDev\QStash\Contracts\Resources\MessageInterface;
use HeyJorgeDev\QStash\Contracts\Resources\QueueInterface;
use HeyJorgeDev\QStash\Contracts\Resources\ScheduleInterface;
use HeyJorgeDev\QStash\ValueObjects\Message;

interface ClientInterface
{
    public function queues(): QueueInterface;

    public function schedules(): ScheduleInterface;

    public function messages(): MessageInterface;

    public function publishJson(
        string $url,
        array $body = [],
    ): Message;
}
