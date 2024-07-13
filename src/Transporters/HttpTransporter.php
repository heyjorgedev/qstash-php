<?php

namespace HeyJorgeDev\QStash\Transporters;

use GuzzleHttp\Psr7\Request;
use HeyJorgeDev\QStash\Contracts\TransporterInterface;
use HeyJorgeDev\QStash\ValueObjects\Transporter\Headers;
use HeyJorgeDev\QStash\ValueObjects\Transporter\Response;
use Psr\Http\Client\ClientInterface as HttpClientInterface;

class HttpTransporter implements TransporterInterface
{
    public function __construct(
        private HttpClientInterface $httpClient,
        private Headers $headers,
    ) {}

    public function request(string $method, string $path, array $options = []): Response
    {
        $request = new Request($method, $path, $this->headers->toArray(), $options['body'] ?? null);

        $response = $this->httpClient->sendRequest($request);

        return new Response(
            $response->getStatusCode(),
            [],
            new Headers($response->getHeaders())
        );
    }
}
