<?php

namespace HeyJorgeDev\QStash;

use HeyJorgeDev\QStash\Transporters\HttpTransporter;
use Psr\Http\Client\ClientInterface as HttpClientInterface;

class Factory
{
    private ?string $apiKey = null;

    private ?HttpClientInterface $httpClient = null;

    public function withApiKey(string $apiKey): Factory
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    public function make(): Client
    {
        return new Client(new HttpTransporter());
    }
}
