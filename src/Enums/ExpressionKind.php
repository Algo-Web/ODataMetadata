<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Enums;

/**
 * Class ExpressionKind.
 *
 *  Defines EDM expression kinds.
 *
 * @package AlgoWeb\ODataMetadata\Enums
 * @method static self None() Represents an expression with unknown or error kind.
 * @method bool isNone()
 * @method static self BinaryConstant() Represents an expression implementing IBinaryConstantExpression
 * @method bool isBinaryConstant()
 * @method static self BooleanConstant() Represents an expression implementing IBooleanConstantExpression
 * @method bool isBooleanConstant()
 * @method static self DateTimeConstant() Represents an expression implementing IDateTimeConstantExpression
 * @method bool isDateTimeConstant()
 * @method static self DateTimeOffsetConstant() Represents an expression implementing IDateTimeOffsetConstantExpression
 * @method bool isDateTimeOffsetConstant()
 * @method static self DecimalConstant() Represents an expression implementing IDecimalConstantExpression
 * @method bool isDecimalConstant()
 * @method static self FloatingConstant() Represents an expression implementing IFloatingConstantExpression
 * @method bool isFloatingConstant()
 * @method static self GuidConstant() Represents an expression implementing IGuidConstantExpression
 * @method bool isGuidConstant()
 * @method static self IntegerConstant() Represents an expression implementing IIntegerConstantExpression
 * @method bool isIntegerConstant()
 * @method static self StringConstant() Represents an expression implementing IStringConstantExpression
 * @method bool isStringConstant()
 * @method static self TimeConstant() Represents an expression implementing ITimeConstantExpression
 * @method bool isTimeConstant()
 * @method static self Null() Represents an expression implementing INullExpression
 * @method bool isNull()
 * @method static self Record() Represents an expression implementing IRecordExpression
 * @method bool isRecord()
 * @method static self Collection() Represents an expression implementing ICollectionExpression
 * @method bool isCollection()
 * @method static self Path() Represents an expression implementing IPathExpression
 * @method bool isPath()
 * @method static self ParameterReference() Represents an expression implementing IParameterReferenceExpression
 * @method bool isParameterReference()
 * @method static self FunctionReference() Represents an expression implementing IFunctionReferenceExpression
 * @method bool isFunctionReference()
 * @method static self PropertyReference() Represents an expression implementing IPropertyReferenceExpression
 * @method bool isPropertyReference()
 * @method static self ValueTermReference() Represents an expression implementing IValueTermReferenceExpression
 * @method bool isValueTermReference()
 * @method static self EntitySetReference() Represents an expression implementing IEntitySetReferenceExpression
 * @method bool isEntitySetReference()
 * @method static self EnumMemberReference() Represents an expression implementing IEnumMemberReferenceExpression
 * @method bool isEnumMemberReference()
 * @method static self If() Represents an expression implementing IIfExpression
 * @method bool isIf()
 * @method static self AssertType() Represents an expression implementing IAssertTypeExpression
 * @method bool isAssertType()
 * @method static self IsType() Represents an expression implementing IIsTypeExpression
 * @method bool isIsType()
 * @method static self FunctionApplication() Represents an expression implementing IApplyExpression
 * @method bool isFunctionApplication()
 * @method static self LabeledExpressionReference() Represents an expression implementing ILabeledExpressionReferenceExpression
 * @method bool isLabeledExpressionReference()
 * @method static self Labeled() Represents an expression implementing ILabeledExpression
 * @method bool isLabeled()
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
