<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Enums;

/**
 * Class EdmContainerElementKind.
 *
 * Defines EDM container element types.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Enums
 * @method static self None() Represents an element where the container kind is unknown or in error.
 * @method bool isEntitySet()
 * @method static self EntitySet() Represents an element implementing IEdmEntitySet
 * @method bool isNone()
 * @method static self FunctionImport() Represents an element implementing IEdmFunctionImport
 * @method bool isFunctionImport()
 */
class ContainerElementKind extends Enum
{
    protected const None           = 1;
    protected const EntitySet      = 2;
    protected const FunctionImport = 3;
}
