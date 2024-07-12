<?php

namespace HeyJorgeDev\QStash\Resources;

use HeyJorgeDev\QStash\Contracts\Resources\ScheduleInterface;
use HeyJorgeDev\QStash\Contracts\TransporterInterface;

class ScheduleResource implements ScheduleInterface
{
    public function __construct(private readonly TransporterInterface $transporter) {}

    public function list()
    {
        // TODO: Implement list() method.
    }

    public function get(string $scheduleName)
    {
        // TODO: Implement get() method.
    }

    public function delete(string $scheduleName)
    {
        // TODO: Implement delete() method.
    }
}
