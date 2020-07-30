<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces\Values;

use DateTime;

/**
 * Interface IDateTimeValue.
 *
 * Represents an EDM datetime value.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Values
 */
interface IDateTimeValue extends IPrimitiveValue
{
    /**
     * @return DateTime gets the definition of this datetime value
     */
    public function getValue(): DateTime ;
}
