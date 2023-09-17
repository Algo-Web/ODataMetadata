<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces\Values;

/**
 * Interface IGuidValue.
 *
 * Represents an EDM integer value.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Values
 */
interface IGuidValue extends IPrimitiveValue
{
    /**
     * @return string gets the definition of this guid value
     */
    public function getValue(): string;
}
