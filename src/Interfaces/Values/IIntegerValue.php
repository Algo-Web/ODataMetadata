<?php


namespace AlgoWeb\ODataMetadata\Interfaces\Values;

/**
 * Interface IIntegerValue
 *
 * Represents an EDM integer value.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Values
 */
interface IIntegerValue extends IPrimitiveValue
{
    /**
     * @return int Gets the definition of this integer value.
     */
    public function getValue(): int;
}