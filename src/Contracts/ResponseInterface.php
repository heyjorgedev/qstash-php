<?php

namespace HeyJorgeDev\QStash\Contracts;

interface ResponseInterface
{
    public function isSuccessful(): bool;

    public function getErrors(): array;
}
