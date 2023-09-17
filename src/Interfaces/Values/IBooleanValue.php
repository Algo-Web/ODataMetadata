<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces\Values;

/**
 * Interface IEdmBooleanValue.
 *
 * Represents an EDM boolean value.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Values
 */
interface IBooleanValue extends IPrimitiveValue
{
    /**
     * @return bool gets a value indicating whether the value of this boolean value is true or false
     */
    public function getValue(): bool ;
}
