<?php

declare(strict_types = 1);

namespace App\Exception;

use LogicException as NativeLogicException;
use Throwable;

final class LogicException extends NativeLogicException
{

    public function __construct(string $message, ?Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }

    public static function fromException(Throwable $e): self
    {
        return new self($e->getMessage(), $e);
    }

}
