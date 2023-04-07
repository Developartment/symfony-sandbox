<?php

declare(strict_types = 1);

namespace App\Exception;

class NoUserFoundException extends RuntimeException
{

    public static function getById(int $id): self
    {
        return new self("No store #{$id} found.");
    }

}
