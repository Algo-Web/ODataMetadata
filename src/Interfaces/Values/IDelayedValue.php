<?php


namespace AlgoWeb\ODataMetadata\Interfaces\Values;

/**
 * Interface IDelayedValue
 *
 *  Represents a lazily computed value.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Values
 */
interface IDelayedValue
{
    /**
     * @return IValue Gets the data stored in this value.
     */
    public function getValue();
}