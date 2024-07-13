<?php

namespace HeyJorgeDev\QStash\Transporters;

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
        return new Response(200, [], new Headers([]));
    }
}
