<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces\Values;

/**
 * Interface IDecimalValue.
 *
 * Represents an EDM decimal value.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Values
 */
interface IDecimalValue extends IPrimitiveValue
{
    /**
     * @return float gets the definition of this decimal  value
     */
    public function getValue(): float ;
}
