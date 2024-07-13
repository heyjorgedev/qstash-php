<?php

namespace HeyJorgeDev\QStash;

use HeyJorgeDev\QStash\Transporters\HttpTransporter;
use HeyJorgeDev\QStash\ValueObjects\Transporter\Headers;
use Http\Discovery\Psr18ClientDiscovery;
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
        $headers = new Headers();

        if ($this->apiKey) {
            $headers = $headers->withAuthorization($this->apiKey);
        }

        $client = $this->httpClient ??= Psr18ClientDiscovery::find();

        $transporter = new HttpTransporter($client, $headers);

        return new Client($transporter);
    }
}
