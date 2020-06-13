<?php


namespace AlgoWeb\ODataMetadata\Interfaces\Values;


use DateTime;

/**
 * Interface IDateTimeOffsetValue
 *
 * Represents an EDM datetime with offset value.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Values
 */
interface IDateTimeOffsetValue extends IPrimitiveValue
{
    /**
     * @return DateTime Gets the definition of this value.
     */
public function getValue(): DateTime;
}