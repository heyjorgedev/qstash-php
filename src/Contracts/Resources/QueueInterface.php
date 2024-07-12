<?php

namespace HeyJorgeDev\QStash\Contracts\Resources;

interface QueueInterface
{
    public function list();

    public function get(string $queueName);

    public function delete(string $queueName);
}
