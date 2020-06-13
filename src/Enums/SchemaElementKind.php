<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Enums;

/**
 * Class EdmSchemaElementKind.
 *
 * Defines EDM schema element types.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Enums
 * @method static None(): self  Represents a schema element with unknown or error kind.
 * @method static TypeDefinition(): self Represents a schema element implementing @see ISchemaType
 * @method static Function(): self Represents a schema element implementing @see IFunction
 * @method static ValueTerm(): self Represents a schema element implementing @see IValueTerm
 * @method static EntityContainer(): self Represents a schema element implementing @see IEntityContainer
 */
class SchemaElementKind extends Enum
{
    protected const None            = null;
    protected const TypeDefinition  = 'SchemaType';
    protected const Function        = 'Function';
    protected const ValueTerm       = 'ValueTerm';
    protected const EntityContainer = 'EntityContainer';
}
