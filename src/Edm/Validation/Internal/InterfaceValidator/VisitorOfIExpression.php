<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IApplyExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IAssertTypeExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IBinaryConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IBooleanConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ICollectionExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IDateTimeConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IDateTimeOffsetConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IDecimalConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IEntitySetReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IEnumMemberReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IFloatingConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IFunctionReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IGuidConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIfExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIntegerConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIsTypeExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ILabeledExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ILabeledExpressionReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\INullExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IParameterReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IPathExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IPropertyReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IRecordExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IStringConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ITimeConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IValueTermReferenceExpression;

class VisitorOfIExpression extends VisitorOfT
{
    protected $lookup = [];

    public function __construct()
    {
        $this->lookup[ExpressionKind::IntegerConstant()->getValue()]            = IIntegerConstantExpression::class;
        $this->lookup[ExpressionKind::StringConstant()->getValue()]             = IStringConstantExpression::class;
        $this->lookup[ExpressionKind::BinaryConstant()->getValue()]             = IBinaryConstantExpression::class;
        $this->lookup[ExpressionKind::BooleanConstant()->getValue()]            = IBooleanConstantExpression::class;
        $this->lookup[ExpressionKind::DateTimeConstant()->getValue()]           = IDateTimeConstantExpression::class;
        $this->lookup[ExpressionKind::DateTimeOffsetConstant()->getValue()]     = IDateTimeOffsetConstantExpression::class;
        $this->lookup[ExpressionKind::TimeConstant()->getValue()]               = ITimeConstantExpression::class;
        $this->lookup[ExpressionKind::DecimalConstant()->getValue()]            = IDecimalConstantExpression::class;
        $this->lookup[ExpressionKind::FloatingConstant()->getValue()]           = IFloatingConstantExpression::class;
        $this->lookup[ExpressionKind::GuidConstant()->getValue()]               = IGuidConstantExpression::class;
        $this->lookup[ExpressionKind::Null()->getValue()]                       = INullExpression::class;
        $this->lookup[ExpressionKind::Record()->getValue()]                     = IRecordExpression::class;
        $this->lookup[ExpressionKind::Collection()->getValue()]                 = ICollectionExpression::class;
        $this->lookup[ExpressionKind::Path()->getValue()]                       = IPathExpression::class;
        $this->lookup[ExpressionKind::ParameterReference()->getValue()]         = IParameterReferenceExpression::class;
        $this->lookup[ExpressionKind::FunctionReference()->getValue()]          = IFunctionReferenceExpression::class;
        $this->lookup[ExpressionKind::PropertyReference()->getValue()]          = IPropertyReferenceExpression::class;
        $this->lookup[ExpressionKind::ValueTermReference()->getValue()]         = IValueTermReferenceExpression::class;
        $this->lookup[ExpressionKind::EntitySetReference()->getValue()]         = IEntitySetReferenceExpression::class;
        $this->lookup[ExpressionKind::EnumMemberReference()->getValue()]        = IEnumMemberReferenceExpression::class;
        $this->lookup[ExpressionKind::If()->getValue()]                         = IIfExpression::class;
        $this->lookup[ExpressionKind::AssertType()->getValue()]                 = IAssertTypeExpression::class;
        $this->lookup[ExpressionKind::IsType()->getValue()]                     = IIsTypeExpression::class;
        $this->lookup[ExpressionKind::FunctionApplication()->getValue()]        = IApplyExpression::class;
        $this->lookup[ExpressionKind::Labeled()->getValue()]                    = ILabeledExpression::class;
        $this->lookup[ExpressionKind::LabeledExpressionReference()->getValue()] = ILabeledExpressionReferenceExpression::class;
    }

    protected function VisitT($expression, array &$followup, array &$references): ?iterable
    {
        assert($expression instanceof IExpression);
        // Trying to reduce amount of noise in errors - if this expression is bad, then most likely it will have an
        // unacceptable kind, no need to report it.
        if (InterfaceValidator::IsCheckableBad($expression)) {
            return null;
        }

        $expressionKindError = null;
        $kind                = $expression->getExpressionKind();

        if (!array_key_exists($kind->getValue(), $this->lookup)) {
            $expressionKindError = InterfaceValidator::CreateInterfaceKindValueUnexpectedError(
                $expression,
                $expression->getExpressionKind()->getKey(),
                'ExpressionKind'
            );
        } else {
            $interface           = $this->lookup[$kind->getValue()];
            $expressionKindError = InterfaceValidator::CheckForInterfaceKindValueMismatchError(
                $expression,
                $kind,
                'ExpressionKind',
                $interface
            );
        }

        return [$expressionKindError];
    }

    public function forType(): string
    {
        return IExpression::class;
    }
}
