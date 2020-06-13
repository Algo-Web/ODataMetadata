<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Enums;

/**
 * Class EdmPropertyKind.
 *
 * Defines EDM property types.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Enums
 * @method static None(): self Represents a property with an unknown or error kind.
 * @method static Structural(): self Represents a property implementing @see IStructuralProperty
 * @method static Navigation(): self Represents a property implementing @see IEdmNavigationProperty
 */
class PropertyKind extends Enum
{
    protected const None       = 1;
    protected const Structural = 2;
    protected const Navigation = 3;
}
