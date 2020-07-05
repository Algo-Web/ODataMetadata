<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Enums;

/**
 * Class EdmConcurrencyMode.
 *
 * Enumerates the EDM property concurrency modes.
 *
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Enums
 * @method static self None() Denotes a property that should be used for optimistic concurrency checks.
 * @method bool isNone()
 * @method static self Fixed() Denotes a property that should not be used for optimistic concurrency checks.
 * @method bool isFixed()
 */
class ConcurrencyMode extends Enum
{
    protected const None  = 0;
    protected const Fixed = 1;

    /**
     * Returns the enum key (i.e. the constant name).
     *
     * @return string
     */
    public function getKey()
    {
        return strval(parent::getKey());
    }
}
