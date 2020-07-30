<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Enums;

/**
 * Class EdmTermKind.
 *
 * Defines EDM term kinds.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Enums
 * @method static self None()  Represents a term implementing
 * @method bool   isNone()
 * @method static self Type()  Represents a term implementing @see IStructuredType and @see ISchemaType.
 * @method bool   isType()
 * @method static self Value() Represents a term implementing @see IValueTerm.
 * @method bool   isValue()
 */
class TermKind extends Enum
{
    protected const None  = 1;
    protected const Type  = 2;
    protected const Value = 3;
}
