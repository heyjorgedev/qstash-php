<?php

namespace HeyJorgeDev\QStash\Contracts;

use HeyJorgeDev\QStash\ValueObjects\Transporter\Request;
use HeyJorgeDev\QStash\ValueObjects\Transporter\Response;

interface TransporterInterface
{
    public function request(string $method, string $path, array $options = []): Response;

    public function send(Request $request): Response;
}
