<?php


namespace AlgoWeb\ODataMetadata\Interfaces\Values;

use DateTime;

/**
 * Interface IDateTimeValue
 *
 * Represents an EDM datetime value.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Values
 */
interface IDateTimeValue extends IPrimitiveValue
{
    /**
     * @return DateTime  Gets the definition of this datetime value.
     */
    public function getValue(): DateTime ;
}