<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces\Values;

/**
 * Interface IDelayedValue.
 *
 *  Represents a lazily computed value.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Values
 */
interface IDelayedValue
{
    /**
     * @return IValue gets the data stored in this value
     */
    public function getValue();
}
