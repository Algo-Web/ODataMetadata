<?php


namespace AlgoWeb\ODataMetadata\Interfaces\Values;

/**
 * Interface IEnumValue
 *
 * Represents an EDM enumeration type value.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Values
 */
interface IEnumValue extends IPrimitiveValue
{
    /**
     * @return IPrimitiveValue Gets the underlying type value of the enumeration type.
     */
    public function getValue(): IPrimitiveValue;
}