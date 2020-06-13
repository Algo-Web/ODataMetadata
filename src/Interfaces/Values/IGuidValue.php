<?php


namespace AlgoWeb\ODataMetadata\Interfaces\Values;

/**
 * Interface IGuidValue
 *
 * Represents an EDM integer value.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Values
 */
interface IGuidValue extends IPrimitiveValue
{
    /**
     * @return string Gets the definition of this guid value.
     */
    public function getValue(): string;
}