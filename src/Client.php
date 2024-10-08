<?php

namespace HeyJorgeDev\QStash;

use HeyJorgeDev\QStash\Contracts\ClientInterface;
use HeyJorgeDev\QStash\Contracts\Resources\MessageInterface;
use HeyJorgeDev\QStash\Contracts\Resources\QueueInterface;
use HeyJorgeDev\QStash\Contracts\Resources\ScheduleInterface;
use HeyJorgeDev\QStash\Contracts\TransporterInterface;
use HeyJorgeDev\QStash\Resources\MessageResource;
use HeyJorgeDev\QStash\Resources\QueueResource;
use HeyJorgeDev\QStash\Resources\ScheduleResource;
use HeyJorgeDev\QStash\Responses\MessagePublishResponse;
use HeyJorgeDev\QStash\ValueObjects\MessageToPublish;

class Client implements ClientInterface
{
    public function __construct(private readonly TransporterInterface $transporter) {}

    public function queues(): QueueInterface
    {
        return new QueueResource($this->transporter);
    }

    public function schedules(): ScheduleInterface
    {
        return new ScheduleResource($this->transporter);
    }

    public function messages(): MessageInterface
    {
        return new MessageResource($this->transporter);
    }

    public function publish(MessageToPublish $messageToPublish): MessagePublishResponse
    {
        return $this->messages()->publish($messageToPublish);
    }
}
