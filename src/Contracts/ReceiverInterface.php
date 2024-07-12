<?php

namespace HeyJorgeDev\QStash\Contracts;

interface ReceiverInterface
{
    public function verify(): bool;
}
