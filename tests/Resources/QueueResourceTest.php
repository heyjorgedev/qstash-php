<?php

use HeyJorgeDev\QStash\Resources\QueueResource;
use HeyJorgeDev\QStash\Responses\QueueListResponse;
use HeyJorgeDev\QStash\Tests\Mocks\MockTransporter;
use HeyJorgeDev\QStash\ValueObjects\Queue;
use HeyJorgeDev\QStash\ValueObjects\Transporter\Headers;
use HeyJorgeDev\QStash\ValueObjects\Transporter\Response;

it('can return a list of queues if the request is successful', function () {
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

    $response = $resource->list();

    expect($response)
        ->toBeInstanceOf(QueueListResponse::class)
        ->isSuccessful()->toBeTrue()
        ->getData()->toBeArray()->toHaveCount(1);

});

it('returns isSuccessful false to list queues that is not successful', function () {
    $transporter = new MockTransporter([
        'GET /queues' => new Response(
            statusCode: 500,
            body: [],
            headers: new Headers([
                'Content-Type' => 'application/json',
            ]),
        ),
    ]);

    $resource = new QueueResource($transporter);

    $response = $resource->list();

    expect($response)->isSuccessful()->toBeFalse();
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

    $response = $resource->get('my-queue');

    expect($response)
        ->isSuccessful()->toBeTrue()
        ->getData()->toBeInstanceOf(Queue::class);
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

    $response = $resource->delete('my-queue');

    expect($response)->isSuccessful()->toBeTrue();
});
