<?php

namespace HeyJorgeDev\QStash\Contracts\Resources;

use HeyJorgeDev\QStash\Responses\MessageBatchResponse;
use HeyJorgeDev\QStash\Responses\MessageCancelResponse;
use HeyJorgeDev\QStash\Responses\MessageEnqueueResponse;
use HeyJorgeDev\QStash\Responses\MessagePublishResponse;
use HeyJorgeDev\QStash\ValueObjects\Message;
use HeyJorgeDev\QStash\ValueObjects\MessageToPublish;

interface MessageInterface
{
    public function publish(MessageToPublish $message): MessagePublishResponse;

    public function enqueue(string $queueName, MessageToPublish $message): MessageEnqueueResponse;

    /**
     * @param  array<MessageToPublish>  $messages
     */
    public function batch(array $messages): MessageBatchResponse;

    public function get(string $messageId): Message;

    public function cancel(string $messageId): MessageCancelResponse;

    /**
     * @param  array<string>  $messageIds
     */
    public function bulkCancel(array $messageIds);
}
