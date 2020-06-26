<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Enums;

/**
 * Class EdmSchemaElementKind.
 *
 * Defines EDM schema element types.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Enums
 * @method static self None() Represents a schema element with unknown or error kind.
 * @method static bool isNone()
 * @method static self TypeDefinition() Represents a schema element implementing @see ISchemaType
 * @method static bool isTypeDefinition()
 * @method static self Function() Represents a schema element implementing @see IFunction
 * @method static bool isFunction()
 * @method static self ValueTerm() Represents a schema element implementing @see IValueTerm
 * @method static bool isValueTerm()
 * @method static self EntityContainer() Represents a schema element implementing @see IEntityContainer
 * @method static bool isEntityContainer()
 */
class SchemaElementKind extends Enum
{
    protected const None            = null;
    protected const TypeDefinition  = 'SchemaType';
    protected const Function        = 'Function';
    protected const ValueTerm       = 'ValueTerm';
    protected const EntityContainer = 'EntityContainer';
}
