<?php


namespace AlgoWeb\ODataMetadata\Interfaces\Values;

use DateTime;

/**
 * Interface ITimeValue
 *
 * Represents an EDM time value.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Values
 */
interface ITimeValue
{
    /**
     * @return DateTime Gets the definition of this time value.
     */
    public function getValue(): DateTime;
}