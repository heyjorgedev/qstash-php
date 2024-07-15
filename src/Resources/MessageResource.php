<?php

namespace HeyJorgeDev\QStash\Resources;

use HeyJorgeDev\QStash\Contracts\Resources\MessageInterface;
use HeyJorgeDev\QStash\Contracts\TransporterInterface;
use HeyJorgeDev\QStash\Responses\MessagePublishResponse;
use HeyJorgeDev\QStash\ValueObjects\Message;
use HeyJorgeDev\QStash\ValueObjects\MessageToPublish;
use HeyJorgeDev\QStash\ValueObjects\Transporter\Request;

class MessageResource implements MessageInterface
{
    public function __construct(private readonly TransporterInterface $transporter) {}

    public function publish(MessageToPublish $message): MessagePublishResponse
    {
        $upstashHeaders = $message->toUpstashHeaders();

        $request = Request::POST("/publish/{$message->destination->toString()}")
            ->withBody($message->body)
            ->appendHeaders($upstashHeaders);

        $response = $this->transporter->send($request);

        if (! $response->isSuccessful()) {
            return new MessagePublishResponse(
                $response->statusCode,
                [],
                $response->body
            );
        }

        return new MessagePublishResponse(
            $response->statusCode,
            $response->body,
            []
        );
    }

    public function enqueue()
    {
        // TODO: Implement enqueue() method.
    }

    public function batch()
    {
        // TODO: Implement batch() method.
    }

    public function get(string $messageId): Message
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
