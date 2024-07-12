<?php

namespace HeyJorgeDev\QStash;

use HeyJorgeDev\QStash\Contracts\ReceiverInterface;

class Receiver implements ReceiverInterface
{
    public function verify(): bool
    {
        return false;
    }
}
