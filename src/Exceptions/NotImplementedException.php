<?php

namespace HeyJorgeDev\QStash\Exceptions;

class NotImplementedException extends \Exception
{
    public static function askForContributions(string $feature): self
    {
        return new static(
            sprintf(
                'This feature (%s) is not implemented yet. Please consider contributing to the project.',
                $feature
            )
        );
    }
}
