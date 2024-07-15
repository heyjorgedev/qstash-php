<?php

namespace HeyJorgeDev\QStash\Resources;

use HeyJorgeDev\QStash\Contracts\Resources\ScheduleInterface;
use HeyJorgeDev\QStash\Contracts\TransporterInterface;
use HeyJorgeDev\QStash\Exceptions\NotImplementedException;

class ScheduleResource implements ScheduleInterface
{
    public function __construct(private readonly TransporterInterface $transporter) {}

    public function list()
    {
        throw NotImplementedException::askForContributions('list scheduled jobs');
    }

    public function get(string $scheduleName)
    {
        throw NotImplementedException::askForContributions('get scheduled job');
    }

    public function delete(string $scheduleName)
    {
        throw NotImplementedException::askForContributions('delete scheduled job');
    }
}
