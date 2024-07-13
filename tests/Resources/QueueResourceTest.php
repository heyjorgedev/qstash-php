<?php

use HeyJorgeDev\QStash\Models\Queue;
use HeyJorgeDev\QStash\Resources\QueueResource;
use HeyJorgeDev\QStash\Tests\Mocks\MockTransporter;
use HeyJorgeDev\QStash\ValueObjects\Transporter\Headers;
use HeyJorgeDev\QStash\ValueObjects\Transporter\Response;

test('list', function () {
    $transporter = new MockTransporter([
        'GET /queues' => new Response(
            body: [
                [
                    'name' => 'my-queue',
                    'parallelism' => 5,
                    'lag' => 100,
                    'createdAt' => 1623345678001,
                    'updatedAt' => 1623345678001,
                ],
            ],
            headers: new Headers([
                'Content-Type' => 'application/json',
            ]),
        ),
    ]);

    $resource = new QueueResource($transporter);

    $result = $resource->list();

    expect($result)
        ->toBeArray()
        ->toHaveCount(1);

});

test('get', function () {
    $transporter = new MockTransporter([
        'GET /queues/my-queue' => new Response(
            body: [
                'name' => 'my-queue',
                'parallelism' => 5,
                'lag' => 100,
                'createdAt' => 1623345678001,
                'updatedAt' => 1623345678001,
            ],
            headers: new Headers([
                'Content-Type' => 'application/json',
            ]),
        ),
    ]);

    $resource = new QueueResource($transporter);

    $result = $resource->get('my-queue');

    expect($result)->toBeInstanceOf(Queue::class);
});

test('delete', function () {
    $transporter = new MockTransporter([
        'DELETE /queues/my-queue' => new Response(
            headers: new Headers([
                'Content-Type' => 'application/json',
            ]),
        ),
    ]);

    $resource = new QueueResource($transporter);

    $result = $resource->delete('my-queue');

    expect($result)->toBeTrue();
});
