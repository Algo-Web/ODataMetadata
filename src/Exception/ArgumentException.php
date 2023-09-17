<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Exception;

use InvalidArgumentException;
use Throwable;

class ArgumentException extends InvalidArgumentException implements ExceptionInterface
{
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
