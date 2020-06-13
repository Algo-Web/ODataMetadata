<?php


namespace AlgoWeb\ODataMetadata\Interfaces\Values;

/**
 * Interface IFloatingValueextends
 *
 * Represents an EDM floating point value.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Values
 */
interface IFloatingValue extends IPrimitiveValue
{
    /**
     * @return float Gets the definition of this floating   value.
     */
    public function getValue(): float ;
}