<?php


namespace AlgoWeb\ODataMetadata\Interfaces\Values;

/**
 * Interface IBinaryValue
 *
 * Represents an EDM binary value.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Values
 */
interface IBinaryValue extends IPrimitiveValue
{
    /**
     *
     *
     * @return string[] Gets the definition of this binary value.
     */
    public function getValue(): array ;
}