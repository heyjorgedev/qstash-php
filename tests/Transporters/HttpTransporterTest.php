<?php

use GuzzleHttp\Psr7\Response;
use HeyJorgeDev\QStash\Transporters\HttpTransporter;
use HeyJorgeDev\QStash\ValueObjects\Transporter\Headers;
use HeyJorgeDev\QStash\ValueObjects\Transporter\Request;
use HeyJorgeDev\QStash\ValueObjects\Url;
use Psr\Http\Client\ClientInterface;

it('can be initialized', function () {
    $client = Mockery::mock(ClientInterface::class);

    $client->shouldReceive('sendRequest')
        ->andReturn(new Response(200, ['Content-Type' => 'application/json'], '{"hello": "world"}'));

    $transporter = new HttpTransporter($client, new Url('https://example.com'), new Headers([]));

    $response = $transporter->send(Request::GET('http://example.com'));

    expect($response)
        ->statusCode->toBe(200)
        ->body->toBe(['hello' => 'world'])
        ->and($response->headers)
        ->toBeInstanceOf(Headers::class)
        ->toArray()->toBe(['Content-Type' => ['application/json']]);
});
