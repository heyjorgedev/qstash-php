<?php

namespace HeyJorgeDev\QStash\Resources;

use HeyJorgeDev\QStash\Contracts\Resources\MessageInterface;
use HeyJorgeDev\QStash\Contracts\TransporterInterface;
use HeyJorgeDev\QStash\Exceptions\NotImplementedException;
use HeyJorgeDev\QStash\Responses\MessageBatchResponse;
use HeyJorgeDev\QStash\Responses\MessageCancelResponse;
use HeyJorgeDev\QStash\Responses\MessageEnqueueResponse;
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

    public function enqueue(string $queueName, MessageToPublish $message): MessageEnqueueResponse
    {
        $upstashHeaders = $message->toUpstashHeaders();

        $request = Request::POST("/publish/{$queueName}/{$message->destination->toString()}")
            ->withBody($message->body)
            ->appendHeaders($upstashHeaders);

        $response = $this->transporter->send($request);

        if (! $response->isSuccessful()) {
            return new MessageEnqueueResponse(
                $response->statusCode,
                [],
                $response->body
            );
        }

        return new MessageEnqueueResponse(
            $response->statusCode,
            $response->body,
            []
        );
    }

    public function batch(array $messages): MessageBatchResponse
    {
        throw NotImplementedException::askForContributions('batch publish messages');
    }

    public function get(string $messageId): Message
    {
        throw NotImplementedException::askForContributions('get single message');
    }

    public function cancel(string $messageId): MessageCancelResponse
    {
        $request = Request::DELETE("/messages/{$messageId}");

        $response = $this->transporter->send($request);

        if (! $response->isSuccessful()) {
            return new MessageCancelResponse(
                $response->statusCode,
                $response->body
            );
        }

        return new MessageCancelResponse(
            $response->statusCode,
            []
        );
    }

    public function bulkCancel(array $messageIds)
    {
        throw NotImplementedException::askForContributions('bulk cancel messages');
    }
}
