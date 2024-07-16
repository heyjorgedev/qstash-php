<?php

namespace HeyJorgeDev\QStash\Contracts;

interface ReceiverInterface
{
    public function verify(array|string $body, string $signature, string $url): bool;
}
