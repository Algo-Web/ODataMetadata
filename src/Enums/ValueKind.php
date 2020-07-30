<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Enums;

/**
 * Class ValueKind.
 *
 * Defines Edm values
 *
 * @package AlgoWeb\ODataMetadata\Enums
 * @method static self None(): self Represents a value with an unknown or error kind.
 * @method static self Binary(): self Represents a value implementing @see IEdmBinaryValue.
 * @method static self Boolean(): self Represents a value implementing @see IEdmBooleanValue.
 * @method static self Collection(): self Represents a value implementing @see IEdmCollectionValue.
 * @method static self DateTimeOffset(): self Represents a value implementing @see IEdmDateTimeOffsetValue.
 * @method static self DateTime(): self Represents a value implementing @see IEdmDateTimeValue.
 * @method static self Decimal(): self Represents a value implementing @see IEdmDecimalValue.
 * @method static self Enum(): self Represents a value implementing @see IEdmEnumValue.
 * @method static self Floating(): self Represents a value implementing @see IEdmFloatingValue.
 * @method static self Guid(): self Represents a value implementing @see IEdmGuidValue.
 * @method static self Integer(): self Represents a value implementing @see IEdmIntegerValue.
 * @method static self Null(): self Represents a value implementing @see IEdmNullValue.
 * @method static self String(): self Represents a value implementing @see IEdmStringValue.
 * @method static self Structured(): self Represents a value implementing @see IEdmStructuredValue.
 * @method static self Time(): self Represents a value implementing @see IEdmTimeValue.
 */
class ValueKind extends Enum
{
    protected const None          =0;
    protected const Binary        = 1;
    protected const Boolean       =2;
    protected const Collection    =3;
    protected const DateTimeOffset=4;
    protected const DateTime      =5;
    protected const Decimal       =6;
    protected const Enum          =7;
    protected const Floating      =8;
    protected const Guid          =9;
    protected const Integer       =10;
    protected const Null          =11;
    protected const String        =12;
    protected const Structured    =13;
    protected const Time          =14;
}
