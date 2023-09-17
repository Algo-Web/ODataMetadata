<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces\Values;

use DateTime;

/**
 * Interface ITimeValue.
 *
 * Represents an EDM time value.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Values
 */
interface ITimeValue
{
    /**
     * @return DateTime gets the definition of this time value
     */
    public function getValue(): DateTime;
}
