<?php


namespace AlgoWeb\ODataMetadata\Interfaces\Values;

/**
 * Interface IStringValue
 *
 * Represents an EDM string value.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Values
 */
interface IStringValue extends IPrimitiveValue
{
    /**
     * @return string Gets the definition of this string value.
     */
    public function getValue(): string;
}