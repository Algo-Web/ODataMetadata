<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Enums;

/**
 * Class ExpressionKind.
 *
 *  Defines EDM expression kinds.
 *
 * @package AlgoWeb\ODataMetadata\Enums
 * @method static None(): self Represents an expression with unknown or error kind.
 * @method static BinaryConstant(): self Represents an expression implementing IBinaryConstantExpression
 * @method static BooleanConstant(): self Represents an expression implementing IBooleanConstantExpression
 * @method static DateTimeConstant(): self Represents an expression implementing IDateTimeConstantExpression
 * @method static DateTimeOffsetConstant(): self Represents an expression implementing IDateTimeOffsetConstantExpression
 * @method static DecimalConstant(): self Represents an expression implementing IDecimalConstantExpression
 * @method static FloatingConstant(): self Represents an expression implementing IFloatingConstantExpression
 * @method static GuidConstant(): self Represents an expression implementing IGuidConstantExpression
 * @method static IntegerConstant(): self Represents an expression implementing IIntegerConstantExpression
 * @method static StringConstant(): self Represents an expression implementing IStringConstantExpression
 * @method static TimeConstant(): self Represents an expression implementing ITimeConstantExpression
 * @method static Null(): self Represents an expression implementing INullExpression
 * @method static Record(): self Represents an expression implementing IRecordExpression
 * @method static Collection(): self Represents an expression implementing ICollectionExpression
 * @method static Path(): self Represents an expression implementing IPathExpression
 * @method static ParameterReference(): self Represents an expression implementing IParameterReferenceExpression
 * @method static FunctionReference(): self Represents an expression implementing IFunctionReferenceExpression
 * @method static PropertyReference(): self Represents an expression implementing IPropertyReferenceExpression
 * @method static ValueTermReference(): self Represents an expression implementing IValueTermReferenceExpression
 * @method static EntitySetReference(): self Represents an expression implementing IEntitySetReferenceExpression
 * @method static EnumMemberReference(): self Represents an expression implementing IEnumMemberReferenceExpression
 * @method static If(): self Represents an expression implementing IIfExpression
 * @method static AssertType(): self Represents an expression implementing IAssertTypeExpression
 * @method static IsType(): self Represents an expression implementing IIsTypeExpression
 * @method static FunctionApplication(): self Represents an expression implementing IApplyExpression
 * @method static LabeledExpressionReference(): self Represents an expression implementing ILabeledExpressionReferenceExpression
 * @method static Labeled(): self Represents an expression implementing ILabeledExpression
 */
class ExpressionKind extends Enum
{
    protected const None                        = 0;
    protected const BinaryConstant              = 1;
    protected const BooleanConstant             = 2;
    protected const DateTimeConstant            = 3;
    protected const DateTimeOffsetConstant      = 4;
    protected const DecimalConstant             = 5;
    protected const FloatingConstant            = 6;
    protected const GuidConstant                = 7;
    protected const IntegerConstant             = 8;
    protected const StringConstant              = 9;
    protected const TimeConstant                = 10;
    protected const Null                        = 11;
    protected const Record                      = 12;
    protected const Collection                  = 14;
    protected const Path                        = 15;
    protected const ParameterReference          = 16;
    protected const FunctionReference           = 17;
    protected const PropertyReference           = 18;
    protected const ValueTermReference          = 19;
    protected const EntitySetReference          = 20;
    protected const EnumMemberReference         = 21;
    protected const If                          = 22;
    protected const AssertType                  = 23;
    protected const IsType                      = 24;
    protected const FunctionApplication         = 25;
    protected const LabeledExpressionReference  = 26;
    protected const Labeled                     = 27;
}
