<?php


namespace AlgoWeb\ODataMetadata\Enums;

/**
 * Class EdmContainerElementKind
 *
 * Defines EDM container element types.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Enums
 * @method static None(): self Represents an element where the container kind is unknown or in error.
 * @method static EntitySet(): self Represents an element implementing IEdmEntitySet
 * @method static FunctionImport(): self Represents an element implementing IEdmFunctionImport
 */
class ContainerElementKind extends Enum
{
    protected const None = 1;
    protected const EntitySet = 2;
    protected const FunctionImport = 3;
}