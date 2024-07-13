<?php

namespace HeyJorgeDev\QStash\Contracts;

interface ResponseWithDataInterface extends ResponseInterface
{
    public function getData();
}
