<?php

use HeyJorgeDev\QStash\QStash;
use HeyJorgeDev\QStash\Resources\MessageResource;
use HeyJorgeDev\QStash\Resources\QueueResource;
use HeyJorgeDev\QStash\Resources\ScheduleResource;

it('has messages', function () {
    $client = QStash::client('some-api-key');

    expect($client->messages())->toBeInstanceOf(MessageResource::class);
});

it('has queues', function () {
    $client = QStash::client('some-api-key');

    expect($client->queues())->toBeInstanceOf(QueueResource::class);
});

it('has schedules', function () {
    $client = QStash::client('some-api-key');

    expect($client->schedules())->toBeInstanceOf(ScheduleResource::class);
});
