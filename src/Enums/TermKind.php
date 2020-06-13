<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Enums;

/**
 * Class EdmTermKind.
 *
 * Defines EDM term kinds.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Enums
 * @method static None(): self  Represents a term implementing
 * @method static Type(): self Represents a term implementing @see IStructuredType and @see ISchemaType.
 * @method static Value(): self Represents a term implementing @see IValueTerm.
 */
class TermKind extends Enum
{
    protected const None  = 1;
    protected const Type  = 2;
    protected const Value = 3;
}
