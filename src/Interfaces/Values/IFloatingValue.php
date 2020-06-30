<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces\Values;

/**
 * Interface IFloatingValueextends.
 *
 * Represents an EDM floating point value.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Values
 */
interface IFloatingValue extends IPrimitiveValue
{
    /**
     * @return float gets the definition of this floating   value
     */
    public function getValue(): float ;
}
