<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Exception;

use InvalidArgumentException;

/**
 * The exception that is thrown when a method call is invalid for the object's current state.
 */
class InvalidOperationException extends InvalidArgumentException implements ExceptionInterface
{
}
