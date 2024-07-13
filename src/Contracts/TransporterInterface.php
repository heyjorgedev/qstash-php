<?php

namespace HeyJorgeDev\QStash\Contracts;

use HeyJorgeDev\QStash\ValueObjects\Transporter\Response;

interface TransporterInterface
{
    public function request(string $method, string $path, array $options = []): Response;
}
