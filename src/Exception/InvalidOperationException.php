<?php


namespace AlgoWeb\ODataMetadata\Exception;


use InvalidArgumentException;
use Symfony\Component\Console\Exception\ExceptionInterface;

/**
 * The exception that is thrown when a method call is invalid for the object's current state.
 */
class InvalidOperationException extends InvalidArgumentException implements ExceptionInterface
{
}
