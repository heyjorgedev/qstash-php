<?php

namespace HeyJorgeDev\QStash\ValueObjects;

class Url
{
    public function __construct(private readonly string $url) {}

    public function toString(): string
    {
        return $this->url;
    }

    public function append(string $path): self
    {
        $pathHasLeadingSlash = str_starts_with($path, '/');
        if ($pathHasLeadingSlash) {
            $path = substr($path, 1);
        }

        $urlHasTrailingSlash = str_ends_with($this->url, '/');
        if ($urlHasTrailingSlash) {
            return new self($this->url.$path);
        }

        return new self($this->url.'/'.$path);
    }
}
