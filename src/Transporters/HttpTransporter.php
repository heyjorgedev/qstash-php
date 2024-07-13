<?php

namespace HeyJorgeDev\QStash\Transporters;

use GuzzleHttp\Psr7\Request;
use HeyJorgeDev\QStash\Contracts\TransporterInterface;
use HeyJorgeDev\QStash\ValueObjects\Transporter\Headers;
use HeyJorgeDev\QStash\ValueObjects\Transporter\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface as HttpClientInterface;

class HttpTransporter implements TransporterInterface
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly Headers $headers,
    ) {}

    public function request(string $method, string $path, array $options = []): Response
    {
        $request = new Request($method, $path, $this->headers->toArray(), $options['body'] ?? null);

        try {
            $response = $this->httpClient->sendRequest($request);

            return new Response(
                $response->getStatusCode(),
                json_decode($response->getBody()->getContents(), true),
                new Headers($response->getHeaders())
            );
        } catch (ClientExceptionInterface $exception) {
            return new Response($exception->getCode(), [$exception->getMessage()], new Headers([]));
        } catch (\Exception $exception) {
            return new Response(500, [$exception->getMessage()], new Headers([]));
        }
    }
}
