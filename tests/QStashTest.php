<?php

use HeyJorgeDev\QStash\Client;
use HeyJorgeDev\QStash\Factory;
use HeyJorgeDev\QStash\QStash;

it('returns an instance of client using the given api key', function () {
    $key = 'some-api-key';
    $client = QStash::client($key);

    expect($client)
        ->toBeInstanceOf(Client::class)
        ->toUseApiKey($key);
});

it('returns an instance of client using the pre-configured api key', function () {
    $key = 'some-api-key';
    QStash::key($key);
    $client = QStash::client();

    expect($client)
        ->toBeInstanceOf(Client::class)
        ->toUseApiKey($key);
});

it('returns an instance of client using the given key even with a pre-configured api key', function () {
    $key = 'some-api-key';
    QStash::key($key);
    $instanceKey = 'some-other-api-key';
    $client = QStash::client($instanceKey);

    expect($client)
        ->toBeInstanceOf(Client::class)
        ->toUseApiKey($instanceKey);
});

it('returns an instance of factory', function () {
    expect(QStash::factory())->toBeInstanceOf(Factory::class);
});
