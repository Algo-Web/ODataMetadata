<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation;

use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use ReflectionFunction;
use ReflectionMethod;

/**
 * A semantic validation rule.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation
 */
abstract class ValidationRule
{

    /** @noinspection PhpDocMissingThrowsInspection */
    /**
     * Initializes a new instance of the ValidationRule class.
     */
    public function __construct()
    {
    }

    abstract public function __invoke(ValidationContext $context, ?IEdmElement $item);

    abstract public function getValidatedType(): string;
}
