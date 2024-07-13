<?php

use HeyJorgeDev\QStash\Client;
use HeyJorgeDev\QStash\Factory;
use HeyJorgeDev\QStash\QStash;

it('returns an instance of client', function () {
    $client = QStash::client('some-api-key');

    expect($client)->toBeInstanceOf(Client::class);
});

it('returns an instance of factory', function () {
    expect(QStash::factory())->toBeInstanceOf(Factory::class);
});
