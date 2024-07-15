<?php

namespace HeyJorgeDev\QStash\Tests\Mocks;

use HeyJorgeDev\QStash\Contracts\TransporterInterface;
use HeyJorgeDev\QStash\ValueObjects\Transporter\Request;
use HeyJorgeDev\QStash\ValueObjects\Transporter\Response;

class MockTransporter implements TransporterInterface
{
    /**
     * @param  array<string, Response>  $responses
     */
    public function __construct(private array $responses) {}

    public function request(string $method, string $path, array $options = []): Response
    {
        return $this->send((new Request())->withMethod($method)->withUrl($path));
    }

    private function searchForResponse(Request $request): ?Response
    {
        foreach ($this->responses as $key => $response) {
            [$m, $p] = explode(' ', $key);

            if ($request->method === $m && $request->url->toString() === $p) {
                return $response;
            }
        }

        return null;
    }

    public function send(Request $request): Response
    {
        $response = $this->searchForResponse($request);
        if (! $response) {
            throw new \Exception('Response not found');
        }

        return $response;
    }
}
