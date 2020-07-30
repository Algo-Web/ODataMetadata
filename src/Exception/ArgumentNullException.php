<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Exception;

use Symfony\Component\Console\Exception\ExceptionInterface;
use Throwable;

class ArgumentNullException extends ArgumentException implements ExceptionInterface
{
    public function __construct($paramName = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct(sprintf('Value for parameter %s cannot be null.', $paramName), $code, $previous);
    }
}
