<?php

namespace HeyJorgeDev\QStash\Contracts;

interface ResponseInterface
{
    public function isSuccessful(): bool;

    public function getData();

    public function getErrors(): array;
}
