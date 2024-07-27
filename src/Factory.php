<?php

namespace HeyJorgeDev\QStash;

use HeyJorgeDev\QStash\Transporters\HttpTransporter;
use HeyJorgeDev\QStash\ValueObjects\Transporter\Headers;
use HeyJorgeDev\QStash\ValueObjects\Url;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface as HttpClientInterface;

class Factory
{
    private ?string $apiKey = null;

    private ?HttpClientInterface $httpClient = null;

    private Url $baseUrl;

    public function withApiKey(#[\SensitiveParameter] string $apiKey): Factory
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    public function withBaseUrl(string $baseUrl): Factory
    {
        $this->baseUrl = new Url($baseUrl);

        return $this;
    }

    public function make(): Client
    {
        $headers = new Headers([
            'Content-Type' => 'application/json',
        ]);

        if ($this->apiKey) {
            $headers = $headers->withAuthorization($this->apiKey);
        }

        $client = $this->httpClient ??= Psr18ClientDiscovery::find();

        $baseUrl = $this->baseUrl ?? new Url('https://qstash.upstash.io/v2/');

        $transporter = new HttpTransporter($client, $baseUrl, $headers);

        return new Client($transporter);
    }
}
