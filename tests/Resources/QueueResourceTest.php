<?php

use HeyJorgeDev\QStash\Resources\QueueResource;
use HeyJorgeDev\QStash\Tests\Mocks\MockTransporter;
use HeyJorgeDev\QStash\ValueObjects\Transporter\Headers;
use HeyJorgeDev\QStash\ValueObjects\Transporter\Response;

test('list', function () {
    $transporter = new MockTransporter([
        'GET /queues' => new Response(
            statusCode: 200,
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
