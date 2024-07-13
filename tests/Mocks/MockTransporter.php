<?php

namespace HeyJorgeDev\QStash\Tests\Mocks;

use HeyJorgeDev\QStash\Contracts\TransporterInterface;
use HeyJorgeDev\QStash\ValueObjects\Transporter\Response;

class MockTransporter implements TransporterInterface
{
    /**
     * @param  array<string, Response>  $responses
     */
    public function __construct(private array $responses) {}

    public function request(string $method, string $path, array $options = []): Response
    {
        $response = $this->searchForResponse($method, $path);
        if (! $response) {
            throw new \Exception('Response not found');
        }

        return $response;
    }

    private function searchForResponse(string $method, string $path): ?Response
    {
        foreach ($this->responses as $key => $response) {
            [$m, $p] = explode(' ', $key);

            if ($method === $m && $path === $p) {
                return $response;
            }
        }

        return null;
    }
}
