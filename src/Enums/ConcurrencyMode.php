<?php


namespace AlgoWeb\ODataMetadata\Enums;

/**
 * Class EdmConcurrencyMode
 *
 * Enumerates the EDM property concurrency modes.
 *
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Enums
 * @method static None(): self Denotes a property that should be used for optimistic concurrency checks.
 * @method static Fixed(): self Denotes a property that should not be used for optimistic concurrency checks.
 */
class ConcurrencyMode extends Enum
{
    protected const None = 0;
    protected const Fixed = 1;
}