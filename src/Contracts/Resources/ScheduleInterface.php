<?php

namespace HeyJorgeDev\QStash\Contracts\Resources;

interface ScheduleInterface
{
    public function list();

    public function get(string $scheduleName);

    public function delete(string $scheduleName);

    // public function create(string $scheduleName, string $scheduleTime);
}
